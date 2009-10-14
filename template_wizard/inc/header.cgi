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
    sTemplate = """<div class="wheader %s %s %s">   
  <span id="autoMargin">
    <div class="wlogoSmall">
            <div class="logoAbsolute"><a id="wlogoLink" href="http://www.washington.edu/">W</a></div>
            <div><a href="http://www.washington.edu/">University of Washington</a></div>
    </div>
    <div id="wsearch">        
          <form name=form1 id="searchbox_001967960132951597331:04hcho0_drk" action="http://www.google.com/cse">
             <div class="wfield">
                <input type="hidden" name="cx" value="001967960132951597331:04hcho0_drk" />
                <input type="hidden" name="cof" value="FORID:0" />
                <input name="q" type="text" value="Search the UW" class="wTextInput" onclick="make_blank();"/>             
             </div>   
                <input type="submit" class="formbutton" name="sa" value="Go" />
          </form>
    </div>
    <div id="wtext">
        <ul>
            <li><a href="#">UW Home</a></li>
            <li><span class="border"><a href="#">Directories</a></span></li>
            <li><span class="border"><a href="#">Calendar</a></span></li>
            <li><span class="border"><a href="#">Maps</a></span></li>
            <li><span class="border"><a href="#">My UW</a></span></li>
       </ul>
    </div>
  </span>
</div>""" % (head.display())

    print "Content-type: text/html"
    print
    print sTemplate
    ## print head.display(sTemplate,d)

if __name__ == "__main__":
    main()
