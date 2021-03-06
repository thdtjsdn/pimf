Php Is My Framework
===================
Have you ever wished a PHP framework that perfectly adapts to your projects needs, your programming experience and your customers budget? A thin PHP framewrok with less implementing rools and easy to learn how to use it? PIMF is about to satisfy your demands!

[![Build Status](https://secure.travis-ci.org/gjerokrsteski/pimf.png)](http://travis-ci.org/gjerokrsteski/pimf)

PIMF (Php Is My Framework) is a micro framework for PHP that emphasises minimalism and simplicity. It is based on proven design patterns and a fast object relational mapping mechanism, and is designed to be easily updated without having to rewrite your projects. It includes mechanisms for easily coupling controllers to ExtJs and Dojo.

Usecases and documentation
--------------------------
Please read here: http://gjerokrsteski.github.com/pimf/

Contributing and pull request guidelines
----------------------------------------
[GitHub pull requests](https://help.github.com/articles/using-pull-requests) are a great way for everyone in the community to contribute to the PIMF codebase. Found a bug? Just fix it in your fork and submit a pull request. This will then be reviewed, and, if found as good, merged into the main repository.

In order to keep the codebase clean, stable and at high quality, even with so many people contributing, some guidelines are necessary for high-quality pull requests:

- **Branch:** Unless they are immediate documentation fixes relevant for old versions, pull requests should be sent to the `develop` branch only. Make sure to select that branch as target when creating the pull request (GitHub will not automatically select it.)
- **Documentation:** If you are adding a new feature or changing the API in any relevant way, this should be documented.
- **Unit tests:** To keep old bugs from re-appearing and generally hold quality at a high level, the PIMF core is thoroughly unit-tested. Thus, when you create a pull request, it is expected that you unit test any new code you add. For any bug you fix, you should also add regression tests to make sure the bug will never appear again. If you are unsure about how to write tests, the core team or other contributors will gladly help.

