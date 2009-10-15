import sys, os
#import xml.dom.minidom
import unittest
sPath = os.getcwd()       
sys.path.append(sPath) 
from uwtempl import *

class TestHeader(unittest.TestCase):

    def setUp(self):
        self.Header1 = Header()
        self.Header1.color = ('purple')
        self.Header1.wordmark = '1'
        self.Header1.blockw = '0'
        self.Header1.patch = '1'
        self.Header1.search = ('basic')
        self.Header1.owner = ('cheiland')
        self.Header2 = Header()
        self.Header2.owner = ('tcmiller')

    def testload(self):
        self.assertEqual(self.Header1.color, 'purple')
        self.assertEqual(self.Header1._color, self.Header1.color)
        self.assertEqual(self.Header1.wordmark, '1')
        self.assertEqual(self.Header1._wordmark, self.Header1.wordmark)
        self.assertEqual(self.Header1.patch, '1')
        self.assertEqual(self.Header1._patch, self.Header1.patch)
        self.assertEqual(self.Header1.blockw, '0')
        self.assertEqual(self.Header1._blockw, self.Header1.blockw)
        self.assertEqual(self.Header1.search, 'basic')
        self.assertEqual(self.Header1._search, self.Header1.search)

    def testlookup(self):
        self.Header2.lookup()
        self.assertEqual(self.Header2.color, 'purple')
        self.assertEqual(self.Header2._color, self.Header2.color)
        self.assertEqual(self.Header2.wordmark, '1')
        self.assertEqual(self.Header2._wordmark, self.Header2.wordmark)
        self.assertEqual(self.Header2.patch, '0')
        self.assertEqual(self.Header2._patch, self.Header2.patch)
        self.assertEqual(self.Header2.blockw, '1')
        self.assertEqual(self.Header2._blockw, self.Header2.blockw)
        self.assertEqual(self.Header2.search, 'basic')
        self.assertEqual(self.Header2._search, self.Header2.search)

    def testdisplay(self):
        self.assertEqual(self.Header1.display(), ('colorPurple', 'wNo', 'patchYes'))

class TestFooter(unittest.TestCase):

    def setUp(self):
        self.Footer = Footer()
        self.Footer.color = ('purple')
        self.Footer.wordmark = 1
        self.Footer.blockw = 1
        self.Footer.patch = 1

    ## def test_create(self):
    ##     oFooter = Footer(self.xdoc)
    ##     oFooter._guid = ('http://www.washington.edu/externalaffairs/mobile/images/001.png')
    ##     oFooter._thumbnail = ('http://www.washington.edu/externalaffairs/mobile/images/t_001.png')
    ##     oFooter._date = ('2008-10-20')
    ##     oFooter._create('guid',oFooter._guid)
    ##     oFooter._create('pubDate',oFooter._date)
    ##     self.assertEqual(oFooter.item.toxml('utf-8'), '<item><guid>http://www.washington.edu/externalaffairs/mobile/images/001.png</guid><pubDate>2008-10-20</pubDate></item>')

    def testload(self):
        self.assertEqual(self.Footer.color, 'purple')
        self.assertEqual(self.Footer._color, self.Footer.color)
        self.assertEqual(self.Footer.wordmark, 1)
        self.assertEqual(self.Footer._wordmark, self.Footer.wordmark)
        self.assertEqual(self.Footer.blockw, 1)
        self.assertEqual(self.Footer._blockw, self.Footer.blockw)
        self.assertEqual(self.Footer.patch, 1)
        self.assertEqual(self.Footer._patch, self.Footer.patch)
        ## self.assertEqual(self.Footer.date_created, '2009-08-25')
        ## self.assertEqual(self.Footer._date_created, self.Footer.date_created)
        ## self.assertEqual(self.Footer.date_modified, '2009-08-25')
        ## self.assertEqual(self.Footer._date_modified, self.Footer.date_modified)
        ## self.assertEqual(self.Footer.date_accessed, '2009-08-25')
        ## self.assertEqual(self.Footer._date_accessed, self.Footer.date_accessed)

if __name__ == '__main__':
    unittest.main()
