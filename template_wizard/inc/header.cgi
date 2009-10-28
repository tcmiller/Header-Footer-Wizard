#!py/bin/python
""" 
CGI include for creating the UW Header for inclusion in the site
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
    Main section for UW Header CGI Include.
    """
    from uwtempl import Header
    f = cgi.FieldStorage()
    head = Header()
    if f.getfirst("i","").lower():
        head.owner = f.getfirst("i","").lower()
    head.lookup()

    ## How to handle this in the final stage?
    sHead = """
<div id="wheader" class="%s %s %s">""" % (head.display())   
    sBody = """
 <span id="autoMargin">
  <div class="wlogoSmall">
   <div class="logoAbsolute"><a id="wlogoLink" href="http://www.washington.edu/">W</a></div>
   <div><a href="http://www.washington.edu/">University of Washington</a></div>
  </div>""" 
    sSearch = """
  <div id="wsearch">        
   <form name="uwglobalsearch" id="searchbox_001967960132951597331:04hcho0_drk" action="http://www.google.com/cse">
    <div class="wfield">
     <input type="hidden" name="cx" value="001967960132951597331:04hcho0_drk" />
     <input type="hidden" name="cof" value="FORID:0" />
     <input name="q" type="text" value="Search the UW" class="wTextInput" onclick="make_blank();" />
    </div>   
    <input type="submit" class="formbutton" name="sa" value="Go" />
   </form>
  </div>"""
    sFoot = """
  <div id="wtext">
   <ul>
    <li><a href="http://www.washington.edu/">UW Home</a></li>
    <li><span class="wborder"><a href="http://www.washington.edu/home/directories.html">Directories</a></span></li>
    <li><span class="wborder"><a href="http://www.washington.edu/visit/events.html">Calendar</a></span></li>
    <li><span class="wborder"><a href="http://www.washington.edu/maps/">Maps</a></span></li>
    <li><span class="wborder"><a href="http://myuw.washington.edu/">My UW</a></span></li>
   </ul>
  </div>
 </span>
</div>"""

    if head.search == 'no':
    	sOutput = """%s%s%s""" % (sHead,sBody,sFoot)
    else:
    	sOutput = """%s%s%s%s""" % (sHead,sBody,sSearch,sFoot)

    print "Content-type: text/html"
    print
    print sOutput

if __name__ == "__main__":
    main()
    
