#!py/bin/python
""" 
CGI include for creating the UW Footer for inclusion in the site
"""
import cgi

######################## DEBUG #############################
## import pdb
import cgitb
## Necessary to print debug errors to display in browser
cgitb.enable()
######################## DEBUG #############################

__author__ = "Chris Heiland"
__copyright__ = "Copyright 2009, University of Washington"
__credits__ = ["Chris Heiland"]
__license__ = "GPL"
__version__ = "0.1"
__maintainer__ = "Chris Heiland"
__email__ = "cheiland@uw.edu"
__status__ = "Development"

def main():
    """
    Main section for UW Footer CGI Include.
    """
    from uwtempl import Footer
    f = cgi.FieldStorage()
    foot = Footer()
    foot.owner = f.getfirst("i","").lower()
    foot.lookup()

    ## sTemplate = """<div class="wfooter %s %s">   
    ## """ % ()

    print "Content-type: text/html"
    print
    ## print sTemplate

if __name__ == "__main__":
    main()

