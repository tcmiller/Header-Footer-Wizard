Introduction
============

To get a proper environment on ovid, create a virtualenv directory and install
the necessary support files.  Since we need to connect to MySQL, we need a
package to do so.  Ovid does not support the latest version of this package
so here is the path to get it to work.

 $ virtualenv-2.5 py
 $ tar xfvz src/MySQL-python-1.2.1.tar.gz py/
 $ cd py/
 $ bin/activate
 $ easy_install-2.5 -U MySQL-python-1.2.1

