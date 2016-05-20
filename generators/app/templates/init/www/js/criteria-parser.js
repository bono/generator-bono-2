(function() {
  'use strict';

  var MAPPING = {
    '=': 'eq',
    '>': 'gt',
    '<': 'lt',
    '<=': 'lte',
    '>=': 'gte',
  };

  var OPERATORS = {
    '=': 5,
    '>': 5,
    '<': 5,
    '<=': 5,
    '>=': 5,
    'and': 4,
    'or': 3,
    '': 1,
  };

  function Token(type, value) {
    this.type = type;
    this.value = value;
  }

  function Tokenizer() {
    this.rules = [];
    this.q = '';
    this.cache = [];
  }

  Tokenizer.prototype = {
    addRule: function(name, rule) {
      this.rules.push([name, rule]);
    },

    next: function() {
      var result;
      this.rules.some(function(rule) {
        var matches = this.q.match(rule[1]);
        if (matches && 0 === matches.index) {
          this.q = this.q.substr(matches[0].length);
          var m;
          while (!(m = matches.pop()));
          result = new Token(rule[0], m);
          return true;
        }
      }.bind(this));
      return result;
    },

    tokenize: function(q, callback) {
      var hasCallback = 'function' === typeof callback;
      var result = [];

      if (!this.cache[q]) {
        var tokens = [];
        this.q = q;
        while(this.q) {
          var token = this.next();
          tokens.push(token);
          result.push(hasCallback ? callback(token) : token);
        }
        this.cache[q] = tokens;
        return result;
      } else if (hasCallback) {
        return this.cache[q].map(function(token) {
          return callback(token);
        });
      } else {
        return this.cache[q];
      }
    },
  };

  function Expr() {
    this.operator = null;
    this.operands = [];
  }

  Expr.prototype = {
    setOperator: function(token) {
      if (this.operator) throw new Error('Operator already set');
      this.operator = token;
    },
    addOperand: function(token) {
      if (this.operands.length === 2) throw new Error('Operands already full');
      this.operands.push(token);
    },
    isComplete: function() {
      return this.operator !== null && this.operands.length === 2;
    },
    toString: function() {
      return JSON.stringify(this, null, 2);
    },
    compile: function() {
      if (this.isComplete()) {
        var op1, op2;
        switch(this.operator.value) {
          case 'and':
            op1 = this.operands[0] instanceof Expr ? this.operands[0].compile() : this.operands[0];
            op2 = this.operands[1] instanceof Expr ? this.operands[1].compile() : this.operands[1];
            var ands = {};
            var i;
            for(i in op1) {
              ands[i] = op1[i];
            }
            for(i in op2) {
              ands[i] = op2[i];
            }
            return ands;
          case 'or':
            op1 = this.operands[0] instanceof Expr ? this.operands[0].compile() : this.operands[0];
            op2 = this.operands[1] instanceof Expr ? this.operands[1].compile() : this.operands[1];
            var ors = [];
            (op1['!or'] || [op1]).forEach(function(or) {
              ors.push(or);
            });
            (op2['!or'] || [op2]).forEach(function(or) {
              ors.push(or);
            });
            return {
              '!or': ors
            };
          default:
            var result = {};
            result[this.operands[0].value + '!' + MAPPING[this.operator.value]] = this.operands[1].value;
            return result;
        }
      } else {
        return this.operands[0] instanceof Expr ? this.operands[0].compile() : this.operands[0];
      }
    }
  };

  var RULES = [
    [ 'whitespace',   /\s+/ ],
    [ 'operator',     /(?:[<>]=?|=|and|or)/ ],
    [ 'opunct',       /\(/ ],
    [ 'cpunct',       /\)/ ],
    [ 'symbol',       /(?:'([^']+)'|"([^"]+)"|[^\s<>=()]+)/ ],
  ];

  function getNextOperator(tokens, start) {
    for(var i = start + 1; i < tokens.length; i++) {
      switch (tokens[i].type) {
        case 'operator':
          return tokens[i];
        case 'opunct':
        case 'cpunct':
          return null;
      }
    }
  }

  function isLowerPriority(a, b) {
    var aValue = a ? a.value : '';
    var bValue = b ? b.value : '';
    return OPERATORS[aValue] < OPERATORS[bValue];
  }

  function parse(q) {
    var tokens;
    if ('string' === typeof q) {
      var tokenizer = new Tokenizer();
      RULES.forEach(function(rule) {
        tokenizer.addRule(rule[0], rule[1]);
      });

      tokens = tokenizer.tokenize(q);
    } else {
      tokens = q;
    }

    var stack = [];
    var expr;

    for(var i = 0; i < tokens.length; i++) {
      var token = tokens[i];
      var nextOpToken;
      var newExpr;

      expr = stack.pop() || new Expr();

      switch (token.type) {
        case 'symbol':
          expr.addOperand(token);

          var running;
          do {
            running = false;
            if (expr.isComplete()) {
              var prior = stack.pop();
              if (prior) {
                nextOpToken = getNextOperator(tokens, i);
                if (isLowerPriority(prior.operator, nextOpToken)) {
                  stack.push(prior);
                  newExpr = new Expr();
                  newExpr.addOperand(expr);
                  expr = newExpr;
                } else {
                  prior.addOperand(expr);
                  expr = prior;
                  running = true;
                }
              } else {
                newExpr = new Expr();
                newExpr.addOperand(expr);
                expr = newExpr;
              }
            }
          } while(running);
          break;

        case 'operator':
          expr.setOperator(token);
          nextOpToken = getNextOperator(tokens, i);
          if (isLowerPriority(token, nextOpToken)) {
            stack.push(expr);
            expr = new Expr();
          }
          break;

        case 'opunct':
          var subTokens = [];
          for (var j = i + 1; j < tokens.length && tokens[j].type !== 'cpunct'; j++) {
            subTokens.push(tokens[j]);
          }
          i = j;
          var result = parse(subTokens);
          expr.addOperand(result);
          if (expr.isComplete()) {
            newExpr = new Expr();
            newExpr.addOperand(expr);
            expr = newExpr;
          }
          break;

        case 'cpunct':
        case 'whitespace':
          break;

        default:
          throw new Error('Undefined type handler, ' + token.type);
      }

      stack.push(expr);
    }

    if (stack.length !== 1) {
      throw new Error('Something wrong happened');
    }

    return expr.compile();
  }

  window.Expr = Expr;
  window.Expr.parse = parse;

  // function assert(a, b) {
  //   if (JSON.stringify(a) !== JSON.stringify(b)) {
  //     console.error('not match expected', a, 'result', b);
  //     throw new Error('assert failed');
  //   } else {
  //     console.info('match', a, b);
  //   }
  // }

  // assert({'user!eq': 'admin'}, parse('user = admin'));
  // assert({'age!gt': '10'}, parse('age > 10'));
  // assert({'age!gte': '10'}, parse('age >= 10'));
  // assert({'age!gte': '10'}, parse('(age >= 10)'));
  // assert({'age!gte': '10'}, parse('(((age >= 10)))'));
  // assert({
  //   'foo!eq': '1',
  //   '!or': [
  //     { 'bar!eq': '2', },
  //     { 'baz!eq': '3' },
  //   ],
  //   'y!eq': '4'
  // }, parse('foo = 1 and (bar = 2 or baz = 3) and y = 4'));
  // assert({'age!gte': '10', 'foo!gte': '10'}, parse('(age >= 10) and (foo >= 10)'));
  // assert({
  //   '!or': [
  //     {'foo!eq': '1'},
  //     {
  //       'bar!eq': '2',
  //       'baz!eq': '3',
  //     },
  //   ],
  // }, parse('foo =    1      or \t bar = 2 and baz = 3'));
  // assert({
  //   'baz!eq': '1',
  //   '!or': [
  //     {'age!gte': '10'},
  //     {'foo!gte': '11'},
  //   ]
  // }, parse('baz = 1 and (age >= 10 or foo >= 11)'));
  // assert({
  //   '!or': [
  //     {'foo!gte': '10'},
  //     {
  //       'bar!lte': '90',
  //       'baz!lte': '30',
  //     },
  //   ]
  // }, parse('foo >= 10 or bar <= 90 and baz <= 30'));
  // assert({
  //     '!or': [
  //       {'age!gte': '10'},
  //       {'age!lte': '90'},
  //     ],
  //     'name!eq': 'foo'
  //   }, parse('(age >= 10 or age <= 90) and name = foo'));
  // assert({'full_name!eq': 'Januar Siregar'}, parse('full_name = "Januar Siregar"'));
  // assert({'full_name!eq': 'Januar Siregar'}, parse('full_name = \'Januar Siregar\''));
})();