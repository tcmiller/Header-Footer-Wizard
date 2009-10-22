Introduction
============

Please read carefully.  The header.cgi and footer.cgi cannot simply be 
copied into a directory and expected to work.  There are several python-centric 
dependencies necessary for the proper use of the includes.

To get a proper environment on Ovid, create a virtualenv directory and install
the necessary support files.  Since we need to connect to MySQL, we need a
package to do so.  Ovid does not support the latest version of this package
so here is the path to get it to work.

Dependencies
------------

 * python-virtualenv package (Should already be installed on Ovid)
 * MySQL-python (included in src/ directory)
 * The primary MySQL database running under uweb

Installation Instructions
-------------------------

 * Copy the entire inc/ folder on the server using a secure ftp program.
 * Run the following set of commands to create the virtual environment.

 $# Set the .cgi files to executable
 $ chmod +x *.cgi
 $# Create the virtual environment
 $ virtualenv-2.5 py
 $# untar the MySQL-python package to the virtualenv directory
 $ tar xfvz src/MySQL-python-1.2.1.tar.gz py/
 $ cd py/
 $# Install the package into the current virtualenv
 $ bin/easy_install-2.5 -U MySQL-python-1.2.1

 * Run a browser and go to the url.  
 
 There is a index.shtml file included for testing purposes.  Since the includes
 connect to the live MySQL running under uweb, the owner should be represented
 by a row in the accounts table.  If not, currently there will be an error.

 Debugging
 ---------

 The easiest way to debug is to make sure the sections marked with DEBUG are
 active in the includes and the included python library.  In addition, since
 the .cgi files are just python scripts, they can be run from the command-line.

 To run the scripts from the command line, do the following;

  $ cd py/
  $ ./header.cgi

 The same process is possible for the footer.

FAQs
----

 * Why is the directory called py/ ?

 - This is more for convention than anything else.  I wanted something short and 
 simple that represented the fact the directory is a bit unusual

 * Why python?
 
 - Because anyone can read python, and perl large numbers of people
