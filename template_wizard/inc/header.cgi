#!py/bin/python
""" 
CGI include for creating the UW Header for inclusion in the site
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
    Main section for UW Header CGI Include.
    """
    from uwtempl import Header
    f = cgi.FieldStorage()
    head = Header()
    if f.getfirst("i","").lower():
        head.owner = f.getfirst("i","").lower()
    if f.getlist("c"):
        head.cache = f.getlist("c")[0]
    head.lookup()

    ## How to handle this in the final stage?
    sHead = """
<div id="wheader" class="%s %s %s %s">""" % (head.display()) 
    sBody = """
 <div id="autoMargin">
  <div class="wlogoSmall">
   <div class="logoAbsolute"><a id="wlogoLink" href="http://www.washington.edu/">W</a></div>
   <div><a href="http://www.washington.edu/">University of Washington</a></div>
  </div>"""
    sSearch = """ 
  <div id="wsearch">        
   <form name="uwglobalsearch" id="searchbox_008816504494047979142:bpbdkw8tbqc" action="http://www.washington.edu/search">
    <div class="wfield">
     <input type="hidden" name="cx" value="008816504494047979142:bpbdkw8tbqc" />
     <input type="hidden" name="cof" value="FORID:0" />
     <input name="q" type="text" value="Search the UW" id="searchInput" class="wTextInput" />
    </div>   
    <input type="submit" class="formbutton" name="sa" value="Go" />
   </form>
  </div>"""
    sFoot = """
  <div id="wtext">
   <ul>
    <li><a href="http://www.washington.edu/">UW Home</a></li>
    <li><span class="wborder"><a href="http://www.washington.edu/home/directories.html">Directories</a></span></li>
    <li><span class="wborder"><a href="http://www.washington.edu/discover/visit/uw-events">Calendar</a></span></li>
    <li><span class="wborder"><a href="http://www.lib.washington.edu/">Libraries</a></span></li>
    <li><span class="wborder"><a href="http://www.washington.edu/maps/">Maps</a></span></li>
    <li><span class="wborder"><a href="http://myuw.washington.edu/">My UW</a></span></li>
   </ul>
  </div>
 </div>
</div>"""

    sSink = """
<div id="visual-portal-wrapper" class="headerFull">
 <div class="wheader patchYes colorGold %s">
  <div id="autoMargin">
   <div class="wlogoSmall">
    <div class="logoAbsolute"><a id="wlogoLink" href="http://www.washington.edu/">University of Washington</a></div>
   </div>
   <div id="wtext">
    <ul>
     <li><a href="http://www.washington.edu/">UW Home</a></li>
     <li><span class="border"><a href="http://www.washington.edu/home/directories.html">Directories</a></span></li>
     <li><span class="border"><a href="http://www.washington.edu/discover/visit/uw-events">Calendar</a></span></li>
     <li><span class="border"><a href="http://www.lib.washington.edu/">Libraries</a></span></li>
     <li><span class="border"><a href="http://www.washington.edu/maps/">Maps</a></span></li>
     <li><span class="border margRight"><a href="http://myuw.washington.edu/">My UW</a></span></li>
     <li><a href="http://www.uwb.edu/">UW Bothell</a></li>
     <li><span class="border"><a href="http://www.tacoma.washington.edu/">UW Tacoma</a></span></li>
    </ul>
   </div>
  </div>
 </div>
 <div id="bg">
  <div id="header">
   <div id="wsearch">
    <form action="http://www.washington.edu/search" id="searchbox_008816504494047979142:bpbdkw8tbqc" name="uwglobalsearch">
     <div class="wfield">
      <input type="hidden" value="008816504494047979142:bpbdkw8tbqc" name="cx" />
      <input type="hidden" value="FORID:0" name="cof" />
      <input type="text" class="wTextInput" value="Search the UW" id="searchInput" title="Search the UW" name="q" />
     </div>
     <input type="submit" value="Go" name="sa" class="formbutton" />
    </form>
   </div>
   <span id="uwLogo"><a href="http://www.washington.edu/">University of Washington</a></span>
   <p class="tagline"><a href="%s"><span class="taglineGold">%s</a></p>
   <ul id="navg">
    <li class="mainNavLinkLeft">
     <div class="mainNavLinkRight">
      <h4><a class="mainNavLinkNotch" href="http://www.washington.edu/discover/">Discover the UW</a></h4>
      <br class="clear" />
      <div class="text">
       <div class="mainNavBG">
        <ul class="mainNavLinks">
         <li><a href="http://www.washington.edu/discover/">About</a></li>
         <li><a href="http://www.washington.edu/discover/academics/departments">Academic Departments</a></li>
	 <li><a href="http://www.washington.edu/discover/academics">Colleges and Schools</a></li>
	 <li><a href="http://www.washington.edu/diversity/">Diversity</a></li>
	 <li><a href="http://www.washington.edu/discover/educationalexcellence">Educational Excellence</a></li>
	 <li><a href="http://www.gohuskies.com/">Husky Sports</a></li>
	 <li><a href="http://www.washington.edu/discover/leadership">Leadership</a></li>
	 <li><a href="http://www.washington.edu/discover/news">News Central</a></li>
	 <li><a href="http://depts.washington.edu/mediarel/galleries/">Photo Galleries</a></li>
	 <li><a href="http://www.washington.edu/research/">Research at the UW</a></li>
	 <li><a href="http://www.washington.edu/discover/visionvalues">Vision &amp; Values</a></li>
	 <li><a href="http://www.washington.edu/discover/visit">Visit the UW</a></li>
	 <li><a href="http://www.washington.edu/discover/sustainability">Spotlight on Sustainability</a></li>
	 <li><a href="http://www.washington.edu/discover/healthylives">Spotlight on Healthy Lives</a></li>
	 <li><a href="http://www.washington.edu/discover/globalcitizens">Spotlight on Global Citizens</a></li>
	 <li><a href="http://www.washington.edu/discover/innovation">Spotlight on Innovation</a></li>
        </ul>
        <div class="mainNavBlurb">
         <p>
          <a href="http://www.washington.edu/discover"><img src="http://depts.washington.edu/uweb/inc/img/full/nav_discover.jpg" width="200" height="120" alt="Rainier Vista" /></a>
          <br />
          Founded in 1861, the University of Washington is one of the oldest state-supported institutions of higher education on the West Coast and is one of the preeminent research universities in the world. <a href="http://www.washington.edu/discover" class="more-link">Learn more</a>
         </p>
        </div>
        <br class="clear" />
        <br class="clear" />
       </div>
      </div>
     </div>
    </li>
    <li class="mainNavLinkLeft">
     <div class="mainNavLinkRight">
      <h4><a class="mainNavLinkNotch" href="http://www.washington.edu/students/">Current Students</a></h4>
      <br class="clear" />
	  <div class="text">
	   <div class="mainNavBG">
	    <ul class="mainNavLinks">
	     <li><a href="http://www.washington.edu/students/">Student Guide</a></li>
	     <li><a href="http://www.washington.edu/uaa/">Undergraduate Learning</a></li>
	     <li><a href="http://www.washington.edu/provost/studentlife/">Student Life</a></li>
             <li><a href="http://depts.washington.edu/omad/">Diversity Resources</a></li>
	     <li><a href="http://www.washington.edu/uaa/gateway/advising/majors/majoff.php">Choosing a Major</a></li>
	     <li><a href="http://www.washington.edu/uaa/advising/">Advising</a></li>
	     <li><a href="http://www.washington.edu/students/reg/calendar.html">Academic Calendar</a></li>
	     <li><a href="http://www.washington.edu/students/timeschd/">Time Schedule</a></li>
	     <li><a href="http://f2.washington.edu/fm/sfs/tuition">Tuition, Fees</a></li>
	     <li><a href="http://www.washington.edu/students/osfa/">Financial Aid</a></li>
	     <li><a href="http://www.washington.edu/students/reg/regelig.html">Registration Info</a></li>
	     <li><a href="http://careers.washington.edu/">Career Center</a></li>
	     <li><a href="http://hfs.washington.edu/dining/">Dining</a></li>
	     <li><a href="http://www.lib.washington.edu/">Libraries</a></li>
	     <li><a href="http://www.washington.edu/safecampus/">SafeCampus</a></li>
	     <li><a href="http://www.washington.edu/itconnect/forstudents.html">Computing / IT Connect</a></li>
	     <li><a href="http://myuw.washington.edu/">MyUW</a></li>
             <li><a href="http://alpine.washington.edu/">Alpine / Email</a></li>
	    </ul>
	    <div class="mainNavBlurb">
		 <p>
		  <a href="http://www.washington.edu/provost/studentlife/"><img src="http://depts.washington.edu/uweb/inc/img/full/nav_current_students.jpg" width="200" height="120" alt="Student writing" /></a>
		  <br />
		  The UW is committed to improving the student experience. Plans currently are under way to remodel the Husky Union Building, expand the Ethnic Cultural Center and remodel the Hall Health Primary Care Center. Learn more about <a href="http://www.washington.edu/provost/studentlife/" class="more-link">Student Life</a>
		 </p>
	    </div>
	    <br class="clear" />
	    <br class="clear" />
	   </div>
      </div>
     </div>
    </li>
	<li class="mainNavLinkLeft">
	 <div class="mainNavLinkRight">
	  <h4><a class="mainNavLinkNotch" href="http://admit.washington.edu/">Future Students</a></h4>
	  <br class="clear" />
      <div class="text">
	   <div class="mainNavBG">
	    <ul class="mainNavLinks">
	     <li><a href="/discover/admissions">Undergraduate Admissions</a></li>
	     <li><a href="http://www.washington.edu/uaa/gateway/advising/majors/majoff.php">Undergraduate Majors</a></li>
	     <li><a href="http://www.washington.edu/students/crscat/">Course Descriptions</a></li>
	     <li><a href="http://admit.washington.edu/Requirements/Transfer/Plan/CreditPolicies">Transfer Credit Policies</a></li>
             <li><a href="http://www.outreach.washington.edu/conted/">Continuing Education</a></li>
	     <li><a href="http://www.grad.washington.edu/admissions/programs-degrees.shtml">Graduate School</a></li>
	     <li><a href="http://www.washington.edu/provost/studentlife/">Student Life</a></li>
	     <li><a href="http://f2.washington.edu/fm/sfs/tuition">Tuition, Fees</a></li>
	     <li><a href="http://www.washington.edu/students/osfa/">Financial Aid</a></li>
	     <li><a href="http://www.hfs.washington.edu/housing/">Student Housing</a></li>
         <li><a href="http://hfs.washington.edu/dining/">Dining</a></li>
         <li><a href="http://admit.washington.edu/Visit/GuidedTour">Campus Tours</a></li>
	    </ul>
	    <div class="mainNavBlurb">
	     <p>
	      <a href="http://www.washington.edu/discover/educationalexcellence"><img src="http://depts.washington.edu/uweb/inc/img/full/nav_future_students.jpg" width="200" height="133" alt="UW Band" /></a>
	      <br />
	      Exceptional learning opportunities are around every corner. Our students have gone to the moon. Mapped the human genome. Broken the sound barrier. Created vaccines. Negotiated peace. What amazing things will UW grads do next? <a href="http://www.washington.edu/educationalexcellence" class="more-link">Read more</a>
	     </p>
	    </div>
		<br class="clear" />
		<br class="clear" />
	   </div>
	  </div>
	 </div>
	</li>
	<li class="mainNavLinkLeft">
	 <div class="mainNavLinkRight">
	  <h4><a class="mainNavLinkNotch" href="http://www.washington.edu/facultystaff/">Faculty &amp; Staff</a></h4>
	  <br class="clear" />
      <div class="text">
	   <div class="mainNavBG">
	    <ul class="mainNavLinks">
	     <li><a href="http://f2.washington.edu/fm/payroll/payroll/ESS">Employee Self Service</a></li>
	     <li><a href="http://www.washington.edu/admin/hr/">Human Resources</a></li>
	     <li><a href="http://www.washington.edu/admin/" >Administrative Gateway</a></li>
	     <li><a href="http://www.washington.edu/admin/hr/benefits/">Benefits &amp; Work/Life</a></li>
	     <li><a href="http://uw.edu/jobs/">Jobs</a></li>
	     <li><a href="http://www.washington.edu/safecampus/">SafeCampus</a></li>
	     <li><a href="http://www.washington.edu/discover/leadership">Administration</a></li>
	     <li><a href="http://www.washington.edu/faculty/facsen/">Faculty Senate</a></li>
	     <li><a href="http://www.washington.edu/research/">Research at the UW</a></li>
	     <li><a href="http://www.washington.edu/teaching/">Teaching at the UW</a></li>
	     <li><a href="http://www.washington.edu/admin/acadpers/">Academic HR</a></li>
	     <li><a href="http://depts.washington.edu/psoweb/">Professional Staff Organization</a></li>
	     <li><a href="http://www.lib.washington.edu/">Libraries</a></li>
	     <li><a href="http://www.washington.edu/itconnect/">Computing / IT Connect</a></li>
	     <li><a href="http://myuw.washington.edu/">MyUW</a></li>
	     <li><a href="http://www.washington.edu/home/directories.html">Office, Staff Directories</a></li>
	     <li><a href="http://www.washington.edu/admin/rules/policies/">Policy Directory</a></li>
	     <li><a href="http://alpine.washington.edu/">Alpine / Email</a></li>
	    </ul>
		<div class="mainNavBlurb">
		 <p>
		  <a href="http://www.washington.edu/discover/visionvalues"><img src="http://depts.washington.edu/uweb/inc/img/full/nav_faculty_staff.jpg" width="200" height="120" alt="Faculty/Staff photo" /></a>
		  <br />
		  The University of Washington recruits the best, most diverse and innovative faculty and staff from around the world, encouraging a vibrant intellectual community for our students. We promote access to excellence and strive to inspire through education. <a href="http://www.washington.edu/discover/visionvalues" class="more-link">Vision &amp; Values</a>
		 </p>
		</div>
		<br class="clear" />
		<br class="clear" />
	   </div>
      </div>
     </div>
	</li>
	<li class="mainNavLinkLeft">
	 <div class="mainNavLinkRight">
	  <h4><a class="mainNavLinkNotch" href="http://www.washington.edu/alumni/">Alumni</a></h4>
	  <br class="clear" />
	  <div class="text">
	   <div class="mainNavBG">
	    <ul class="mainNavLinks">
	     <li><a href="http://www.washington.edu/alumni/meet/">Connect with other Alumni</a></li>
	     <li><a href="http://www.washington.edu/alumni/events/">Alumni Events</a></li>
	     <li><a href="http://www.washington.edu/alumni/services/index.html">Alumni Services</a></li>
	     <li><a href="http://www.washington.edu/alumni/careers/">Networking and Careers</a></li>
	     <li><a href="http://www.washington.edu/alumni/act/">Volunteer Opportunities</a></li>
	     <li><a href="http://www.washington.edu/alumni/tours/">UW Alumni Tours</a></li>
	     <li><a href="http://www.washington.edu/alumni/learn/">Lifelong Learning</a></li>
	     <li><a href="http://www.washington.edu/alumni/membership/">UWAA Membership</a></li>
	     <li><a href="http://www.washington.edu/alumni/meet/facebook.html">UWAA on Facebook</a></li>
	     <li><a href="http://www.washington.edu/alumni/columns/">Columns Magazine</a></li>
	     <li><a href="http://www.washington.edu/alumni/viewpoints/">Viewpoints Magazine</a></li>
	     <li><a href="http://www.washington.edu/giving/make-a-gift">Support the UW</a></li>
	    </ul>
		<div class="mainNavBlurb">
		 <p>
		  <a href="http://www.washington.edu/alumni/meet/groups/happyhours.html"><img src="http://depts.washington.edu/uweb/inc/img/full/nav_alumni.jpg" width="210" height="96" alt="Alumni graphic" /></a>
		  <br />
		  No matter where you are, Husky Happy Hours are a great way to plug into the University of Washington's strong network of alumni. Connect with UW grads in a casual setting and meet fellow alumni in your area. <a href="http://www.washington.edu/alumni/meet/groups/happyhours.html" class="more-link">Details</a>
		 </p>
		</div>
		<br class="clear" />
		<br class="clear" />
	   </div>
	  </div>
	 </div>
	</li>
	<li class="mainNavLinkLeft">
     <div class="mainNavLinkRight">
      <h4><a class="mainNavLinkNotch" href="http://www.washington.edu/nwneighbors/">NW Neighbors</a></h4><br class="clear" />
      <div class="text">
       <div class="mainNavBG">
	    <ul class="mainNavLinks">
	     <li><a href="http://www.washington.edu/community/">UW in the Neighborhood</a></li>
	     <li><a href="http://www.meany.org/tickets/">Arts UW Ticket Office</a></li>
             <li><a href="http://depts.washington.edu/uwbg/">Botanic Gardens</a></li>
             <li><a href="http://www.burkemuseum.org">Burke Museum Visitor Info</a></li>
	     <li><a href="http://www.henryart.org">Henry Art Gallery  Visitor Info</a></li>
	     <li><a href="http://ev12.evenue.net/cgi-bin/ncommerce3/ExecMacro/evenue/ev69/se/Main.d2w/report?linkID=uwash">Husky Sports Ticket Office</a></li>
	     <li><a href="http://www.washington.edu/provost/specialprograms/UUF.html">Using UW Resources</a></li>
	     <li><a href="http://www.lib.washington.edu/services/borrow/visitor.html">UW Libraries Visitor Info</a></li>
	     <li><a href="http://uwmedicine.washington.edu/Patient-Care/Locations/UW-Neighborhood-Clinics/Pages/default.aspx">UW Medicine Neighborhood Clinics</a></li>
             <li><a href="http://www.udistrictchamber.org/">University District</a></li>
             <li><a href="http://www.cityofseattle.net/">City of Seattle</a></li>
	     <li><a href="http://www.visitseattle.org/visitors/">Seattle Tourism</a></li>
	     <li><a href="http://www.experiencewa.com/">The Evergreen State</a></li>
	    </ul>
	    <div class="mainNavBlurb">
	     <p>
	      <a href="http://www.washington.edu/discover/visit/huskycentral"><img src="http://depts.washington.edu/uweb/inc/img/full/nav_nw_neighbors.jpg" width="200" height="133" alt="Husky Central storefront" /></a>
          <br />
          Visit Husky Central in downtown Seattle. It's a one-stop location for "everything Husky." <a href="http://www.washington.edu/discover/visit/huskycentral" class="more-link">Store info</a>
         </p>
        </div>
        <br class="clear" />
        <br class="clear" />
	   </div>
	  </div>
     </div>
    </li>
    <li class="medicineLogo"><a href="http://uwmedicine.washington.edu/">UW Medicine</a></li>
   </ul>
  </div>
 </div>
</div>
""" % (head.sink_sesqui())

    if head.selection == 'sink':
        sOutput = sSink
    elif head.search == 'no':
    	sOutput = """%s%s%s""" % (sHead,sBody,sFoot)
    else:
    	sOutput = """%s%s%s%s""" % (sHead,sBody,sSearch,sFoot)

    print "Content-type: text/html"
    print
    print sOutput

if __name__ == "__main__":
    main()
    
