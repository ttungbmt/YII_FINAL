KARMA = node_modules/karma/bin/karma
MOCHA = ./node_modules/mocha/bin/_mocha
SRCS = ./index.js ./karma.conf.js ./webpack.conf.js lib/*.js test/specs/*.js test/specs/*.js


lint:
	@node_modules/.bin/eslint --config .eslintrc $(SRCS)

dist: lint node_modules
	@./task/dist

minify: lint node_modules
	@./task/minify

semi: lint
	@node_modules/.bin/semi rm $(SRCS) --silent

node_modules: package.json
	@npm install

test: semi node_modules
	@$(KARMA) start

browser:
	@VUE_VALIDATOR_TYPE=browser $(MAKE) test

coverage:
	@VUE_VALIDATOR_TYPE=coverage $(MAKE) test

coveralls:
	@VUE_VALIDATOR_TYPE=coveralls $(MAKE) test

e2e:
	@$(MOCHA) -R dot ./test/e2e/registration.js

coolkids:
	@VUE_VALIDATOR_TYPE=sauce SAUCE=batch1 $(MAKE) test
	
ie:
	@VUE_VALIDATOR_TYPE=sauce SAUCE=batch2 $(MAKE) test

mobile:
	@VUE_VALIDATOR_TYPE=sauce SAUCE=batch3 $(MAKE) test

sauce: coolkids ie mobile

ci: coverage coveralls e2e sauce

clean:
	@rm -rf coverage
	@rm -rf dist


.PHONY: dist lint test coverage node_modules clean
