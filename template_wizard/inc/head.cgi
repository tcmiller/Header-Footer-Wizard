#!py/bin/python
""" 
CGI include for creating the support files for the header/footer
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
    Main section for UW Head CGI Include.
    """
    from uwtempl import Footer 
    f = cgi.FieldStorage()
    foot = Footer()
    if f.getfirst("i","").lower():
        foot.owner = f.getfirst("i","").lower()
    foot.lookup()

    sHead = """<link rel="stylesheet" href="/uweb/inc/css/header.css" type="text/css" media="screen" />"""
    sFoot = """<link rel="stylesheet" href="/uweb/inc/css/footer.css" type="text/css" media="screen" />"""
    sFootNoPatch = """<link rel="stylesheet" href="/uweb/inc/css/footer_no_patch.css" type="text/css" media="screen" />"""

    ## jQuery or plain javascript?
    sGlobal = """<script type="text/javascript">// clear out the global search input text field
    function make_blank() {document.uwglobalsearch.q.value = "";}</script>"""

    if foot.patch == '0':
        sFooter = sFootNoPatch
    else:
        sFooter = sFoot

    sOutput = """%s%s%s""" % (sHead,sFooter,sGlobal)

    print "Content-type: text/html"
    print
    print sOutput

if __name__ == "__main__":
    main()
