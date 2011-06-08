#!py/bin/python
""" 
CGI include for creating the support files for the header/footer
"""
import cgi

######################## DEBUG #############################
## import pdb
## import cgitb
## Necessary to print debug errors to display in browser
## cgitb.enable()
######################## DEBUG #############################

__author__ = "Chris Heiland"
__copyright__ = "Copyright 2009, University of Washington"
__credits__ = ["Chris Heiland"]
__license__ = "GPL"
__version__ = "0.5"
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
    
    from uwtempl import Header
    h = cgi.FieldStorage()
    head = Header()
    if h.getfirst("i","").lower():
        head.owner = h.getfirst("i","").lower()
    if h.getlist("c"):
        head.cache = h.getlist("c")[0]
    head.lookup()
    
    if head.selection == 'sink':
        sHead = """
<link rel="stylesheet" href="/uweb/inc/css/header-full.css" type="text/css" />"""
    else:
        sHead = """
<link rel="stylesheet" href="/uweb/inc/css/header.css" type="text/css" />"""
    sFoot = """
<link rel="stylesheet" href="/uweb/inc/css/footer.css" type="text/css" />"""
    sPrint = """
<link rel="stylesheet" href="/uweb/inc/css/print.css" type="text/css" media="print" />"""

    ## jQuery or plain javascript?
    sGlobal = """
<script type="text/javascript">// clear out the global search input text field
    window.onload = function() {
    
     if (document.getElementById('searchInput')) {
    
       var query = document.getElementById('searchInput');
    
       query.onfocus = function() {
         if (query.value == query.defaultValue) {
           query.value = '';
         }
       }
    
       query.onblur = function() {
         if (query.value == '') {
           query.value = query.defaultValue;
         }
       }
    
     }
    
}
</script>"""

    sOutput = """%s%s%s%s""" % (sHead,sFoot,sPrint,sGlobal)

    print "Content-type: text/html"
    print
    print sOutput

if __name__ == "__main__":
    main()
