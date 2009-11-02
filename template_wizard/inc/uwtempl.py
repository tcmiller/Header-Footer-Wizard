import _mysql
import os
import pickle
from string import Template
############## DEBUG ##############
## import pdb; pdb.set_trace();
############## DEBUG ##############

class MySQL(object):
    """
    This is the generic class to wrap the _mysql connection and hold the
    details used in the transaction.
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

class MyCache(object):
    """
    For performance we turn to pickle.  This is the class that wraps it.
    Actual storage on disk is in the cache/ directory, this assumes we 
    pass it a python object.
    """
    def __init__(self,obj):
        self._id = obj.owner
        self._path = os.getcwd()
        self._data = obj
        self._storage = self._path+'/cache/'+self._id+'-data.pkl'
        self._fh = "" 
    def get_data(self):
        # This fails if a string is returned, ignoring
        # normal formatting and just assuming everything
        # is untanted
        return self._data
    def set_data(self,data):
        self._data = data
    def dump(self):
        self._fh = open(self._storage,'wb')
        pickle.dump(self._data, self._fh)
        self._cleanup()
    def load(self):
        # There might be a case where we can't find 
        # the file, should return something so we know
        if os.path.isfile(self._storage):
            self._fh = open(self._storage,'rb')
            self._data = pickle.load(self._fh)
            self._cleanup()
    def clear(self):
        self.data = ""
        if os.path.isfile(self._storage):
            os.remove(self._storage)
    def _cleanup(self):
        self._fh.close()

    data = property(get_data, set_data)

class Header(object):
    """
    Header object creates the actual header used for an include across the site
    when anyone need to automagically generate the HTML for the brand.
    """
    def __init__(self):
        self.id = ""
        self._owner = ""
        self._color = "gold"
        self._wordmark = "1"
        self._blockw = "1"
        self._patch = "1"
        self._search = "basic"
        self._cache = "1"
        self._date_created = ""
        self._date_modified = ""
        self._date_accessed = ""
    def get_owner(self):
        return "%s" % (self._owner)
    def set_owner(self, owner):
        self._owner = owner
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
    def set_patch(self, patch):
        self._patch = patch
    def get_patch(self):
        return self._patch
    def get_search(self):
        return "%s" % (self._search)
    def set_search(self, search):
        self._search = search
    def get_cache(self):
        return "%s" % (self._cache)
    def set_cache(self, cache):
        self._cache = cache
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
        if len(self.owner) > 0:
            cache = MyCache(self)
            ## Force clearing of cache if requested
            if self.cache == '1':
                cache.load()
            else:
                cache.clear()
            ## If cache exists, then use it
            if cache.data is None:
                self = cache.data
            else:
                db = MySQL()
                db.connect()
                db.load("""select header.id,header.blockw,header.patch,header.color,header.search,header.wordmark from header WHERE header.owner='%s' order by header.created_date DESC""" % (self.owner))
                if db.data is not None:
                    self.id = db.data[0][0]
                    self.blockw = db.data[0][1]
                    self.patch = db.data[0][2]
                    self.color = db.data[0][3]
                    self.search = db.data[0][4]
                    self.wordmark = db.data[0][5]
                    # If cache is turned off, file still generated
                    # to create updated version of cache
                    cache = MyCache(self)
                    cache.dump()

    def display(self):
        color = {'gold':'colorGold','purple':'colorPurple'}
        patch = {'1':'patchYes','0':'patchNo'}
        blockw = {'1':'wYes','0':'wNo'}
    	return (color[self.color],blockw[self.blockw],patch[self.patch])

    owner = property(get_owner, set_owner)
    color = property(get_color, set_color)
    wordmark = property(get_wordmark, set_wordmark)
    blockw = property(get_blockw, set_blockw)
    patch = property(get_patch, set_patch)
    search = property(get_search, set_search)
    cache = property(get_cache, set_cache)
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
        self._owner = ""
        self._wordmark = "0"
        self._blockw = "0"
        self._patch = "purple"
        self._cache = "1"
        self._date_created = ""
        self._date_modified = ""
        self._date_accessed = ""
    def get_owner(self):
        return "%s" % (self._owner)
    def set_owner(self, owner):
        self._owner = owner
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
    def get_cache(self):
        return "%s" % (self._cache)
    def set_cache(self, cache):
        self._cache = cache
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
        if len(self.owner) > 0:
            cache = MyCache(self)
            ## Force clearing of cache if requested
            if self.cache == "1":
                cache.load()
            else:
                cache.clear()
            ## If cache exists, then use it
            if cache.data is None:
                self = cache.data
            else:
                if db.data is not None:
                    db = MySQL()
                    db.connect()
                    db.load("""select footer.id,footer.blockw,footer.patch,footer.wordmark from footer WHERE footer.owner='%s' order by footer.created_date DESC""" % (self.owner))
                    self.id = db.data[0][0]
                    self.blockw = db.data[0][1]
                    self.patch = db.data[0][2]
                    self.wordmark = db.data[0][3]
                    # If cache is turned off, file still generated
                    # to create updated version of cache
                    cache = MyCache(self)
                    cache.dump()
    
    def display_blockw(self):
    	blockw = {'1':'wYes','0':'wNo'}
    	return (blockw[self.blockw])

    owner = property(get_owner, set_owner)
    wordmark = property(get_wordmark, set_wordmark)
    blockw = property(get_blockw, set_blockw)
    patch = property(get_patch, set_patch)
    cache = property(get_cache, set_cache)
    date_created = property(get_date_created, set_date_created)
    date_modified = property(get_date_modified, set_date_modified)
    date_accessed = property(get_date_accessed, set_date_accessed)
