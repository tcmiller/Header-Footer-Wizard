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
    if f.getfirst("i","").lower():
        foot.owner = f.getfirst("i","").lower()
    foot.lookup()
    
    
    if foot.patch == '0':
        sTemplate = """
<div id="footerMain" class="logoYes %s">
 <div id="footerLeft">    	
  <ul>
   <li class="logoArea"><a href="http://www.washington.edu/">&#169; 2009 University of Washington</a></li>  
  </ul>
 </div>
 <div id="footerRight">  
  <ul>
   <li class="centerText"><span>Seattle, Washington</span></li>
  </ul>   
 </div>
 <div id="footerCenter">
  <ul>
   <li><a href="http://www.washington.edu/home/siteinfo/form/">Contact Us</a></li>
   <li class="footerLinkBorder"><a href="http://www.washington.edu/jobs/">Employment</a></li>
   <li class="footerLinkBorder"><a href="http://myuw.washington.edu/">My UW</a></li>
  </ul>
 </div>
</div>""" % (foot.display_blockw())
    else:
    	sTemplate = """
<div id="footerMain" class="%s">
 <div id="footerLogo">
  <a id="wlogoLink" href="http://www.washington.edu/">University of Washington</a>
 </div>
 <div id="footerLinks">
  <div class="logoAbsoluteFooter"></div>
  <h3>Discover what's next. It's the Washington Way</h3>
  <ul>
   <li class="leftText"><span>&#169; 2009 University of Washington</span></li>       	
   <li class="centerText"><span>Seattle, Washington</span></li>         	
   <li class="centerText"><a href="http://www.washington.edu/home/siteinfo/form/">Contact Us</a></li>
   <li class="rightText"><a href="http://www.washington.edu/jobs/">Employment</a></li>
   <li class="rightText"><a href="http://myuw.washington.edu/">My UW</a></li>
  </ul>
 </div>
</div>""" % (foot.display_patch())

    print "Content-type: text/html"
    print
    print sTemplate

if __name__ == "__main__":
    main()

