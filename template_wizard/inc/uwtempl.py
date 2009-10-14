import _mysql
from string import Template
## import pdb

class MySQL(object):
    """
    This is the generic SQL class
    """
    def __init__(self):
        self.user = "inc_script"
        self.passwd = "bdZEdU4LhqlVf2op2VKK"
        self.port = 94582
        self.host = "ovid.u.washington.edu"
        self.datab = "tmplgen"
        self.db = ""
    def connect(self):
        self.db = _mysql.connect(
            host=self.host,
            user=self.user,
            port=self.port,
            passwd=self.passwd,
            db=self.datab)
    def load(self,sSQL):
        self.db.query(sSQL)
        r = self.db.store_result()
        self.data = r.fetch_row()
        self.db.close()

class Header(object):
    """
    Header object creates the actual header used for an include across the site
    when anyone need to automagically generate the HTML for the brand.
    """

    def __init__(self):
        self.id = ""
        self.color = ""
        self.wordmark = ""
        self.blockw = ""
        self.search = ""
        self.date_created = ""
        self.date_modified = ""
        self.date_accessed = ""
        self._template = ""
    def get_color(self):
        return "%s" % (self._color)
    def set_color(self, color):
        self._color = color
    def get_wordmark(self):
        return self._wordmark
    def set_wordmark(self, wordmark):
        self._wordmark = wordmark
    def get_blockw(self):
        return self._blockw
    def set_blockw(self, blockw):
        self._blockw = blockw
    def get_search(self):
        return "%s" % (self._search)
    def set_search(self, search):
        self._search = search
    def get_date_created(self):
        return "%s" % (self._date_created)
    def set_date_created(self, date_created):
        self._date_created = date_created
    def get_date_modified(self):
        return "%s" % (self._date_modified)
    def set_date_modified(self, date_modified):
        self._date_modified = date_modified
    def get_date_accessed(self):
        return "%s" % (self._date_accessed)
    def set_date_accessed(self, date_accessed):
        self._date_accessed = date_accessed
    def lookup(self):
        if self.owner is None:
            return 'Error: set owner first'
        ## pdb.set_trace()
        ## Data connection here?
        db = MySQL()
        db.connect()
        db.load("""select header.id,header.blockw,header.color,header.search,header.wordmark from header join account on account.id=header.account_id WHERE account.owner='%s'""" % (self.owner))
        self.id = db.data[0][0]
        self.blockw = db.data[0][1]
        self.color = str(db.data[0][2])
        self.search = str(db.data[0][3])
        self.wordmark = db.data[0][4]
    ##def display(self,sTempl):
        ## self._template = Template(sTempl)
        ## d = dict(blockw=self.blockw)
        ## return self._template.substitute(d)

    color = property(get_color, set_color)
    wordmark = property(get_wordmark, set_wordmark)
    blockw = property(get_blockw, set_blockw)
    search = property(get_search, set_search)
    date_created = property(get_date_created, set_date_created)
    date_modified = property(get_date_modified, set_date_modified)
    date_accessed = property(get_date_accessed, set_date_accessed)


class Footer(object):
    """
    Footer object creates the actual header used for an include across the site
    when anyone need to automagically generate the HTML for the brand.
    """
    def __init__(self):
        self.id = ""
        self.wordmark = ""
        self.blockw = ""
        self.patch = ""
        self.date_created = ""
        self.date_modified = ""
        self.date_accessed = ""
        self.template = ""
    def get_color(self):
        return "%s" % (self._color)
    def set_color(self, color):
        self._color = color
    def get_wordmark(self):
        return self._wordmark
    def set_wordmark(self, wordmark):
        self._wordmark = wordmark
    def get_blockw(self):
        return self._blockw
    def set_blockw(self, blockw):
        self._blockw = blockw
    def get_patch(self):
        return self._patch
    def set_patch(self, patch):
        self._patch = patch
    def get_date_created(self):
        return "%s" % (self._date_created)
    def set_date_created(self, date_created):
        self._date_created = date_created
    def get_date_modified(self):
        return "%s" % (self._date_modified)
    def set_date_modified(self, date_modified):
        self._date_modified = date_modified
    def get_date_accessed(self):
        return "%s" % (self._date_accessed)
    def set_date_accessed(self, date_accessed):
        self._date_accessed = date_accessed
    def lookup(self):
        if self.owner is None:
            return 'Error: set owner first'
        db = MySQL()
        db.connect()
        db.load("""select footer.id,footer.blockw,footer.patch,footer.wordmark from footer join account on account.id=footer.account_id WHERE account.owner='%s'""" % (self.owner))
        ## pdb.set_trace()
        ## for row in data:
        self.id = db.data[0][0]
        self.blockw = db.data[0][1]
        self.patch = str(db.data[0][2])
        self.wordmark = db.data[0][3]
    def display(self,sTempl):
        self._template = Template(sTempl)
        d = dict(blockw=self.blockw)
        return self._template.substitute(d)

    color = property(get_color, set_color)
    wordmark = property(get_wordmark, set_wordmark)
    blockw = property(get_blockw, set_blockw)
    patch = property(get_patch, set_patch)
    date_created = property(get_date_created, set_date_created)
    date_modified = property(get_date_modified, set_date_modified)
    date_accessed = property(get_date_accessed, set_date_accessed)
