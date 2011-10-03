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
        self.passwd = "replacewithrealpasswordwhenupdatingproduction"
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
        self._selection = "strip"
        self._color = "gold"
        self._wordmark = "1"
        self._blockw = "1"
        self._patch = "1"
        self._sesqui = "0"
        self._sesqui_sink = "0"
        self._search = "basic"
        self._cache = "1"
        self._date_created = ""
        self._date_modified = ""
        self._date_accessed = ""
    def get_owner(self):
        return "%s" % (self._owner)
    def set_owner(self, owner):
        self._owner = owner
    def get_selection(self):
    	return "%s" % (self._selection)
    def set_selection(self, selection):
        self._selection = selection
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
    def set_sesqui(self, sesqui):
        self._sesqui = sesqui
    def get_sesqui(self):
        return self._sesqui
    def set_sesqui_sink(self, sesqui_sink):
        self._sesqui_sink = sesqui_sink
    def get_sesqui_sink(self):
        return self._sesqui_sink
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
                db.load("""select header.id,header.selection,header.blockw,header.patch,header.sesqui,header.sesqui_sink,header.color,header.search,header.wordmark from header WHERE header.owner='%s' order by header.created_date DESC""" % (self.owner))
                if len(db.data) > 0:
                    self.id = db.data[0][0]
                    self.selection = db.data[0][1]
                    self.blockw = db.data[0][2]
                    self.patch = db.data[0][3]
                    self.sesqui = db.data[0][4]
                    self.sesqui_sink = db.data[0][5]
                    self.color = db.data[0][6]
                    self.search = db.data[0][7]
                    self.wordmark = db.data[0][8]
                    # If cache is turned off, file still generated
                    # to create updated version of cache
                    cache = MyCache(self)
                    cache.dump()

    def display(self):
        color = {'gold':'colorGold','purple':'colorPurple'}
        patch = {'1':'patchYes','0':'patchNo'}
        sesqui = {'1':'sesqui','0':''}
        blockw = {'1':'wYes','0':'wNo'}
    	return (color[self.color],blockw[self.blockw],patch[self.patch],sesqui[self.sesqui])
    	
    def sink_sesqui(self):
        sesqui_sink_cls = {'1':'sesqui','0':''}
        sesqui_sink_link = {'1':'http://www.washington.edu/150/','0':'http://www.washington.edu/discovery/washingtonway/'}
        sesqui_sink_tagline = {'1':'Together we make history. Discover what\'s next.','0':'Discover what\'s next. It\'s the Washington Way.'}
        return (sesqui_sink_cls[self.sesqui_sink],sesqui_sink_link[self.sesqui_sink],sesqui_sink_tagline[self.sesqui_sink])

    owner = property(get_owner, set_owner)
    selection = property(get_selection, set_selection)
    color = property(get_color, set_color)
    wordmark = property(get_wordmark, set_wordmark)
    blockw = property(get_blockw, set_blockw)
    patch = property(get_patch, set_patch)
    sesqui = property(get_sesqui, set_sesqui)
    sesqui_sink = property(get_sesqui_sink, set_sesqui_sink)
    search = property(get_search, set_search)
    cache = property(get_cache, set_cache)
    date_created = property(get_date_created, set_date_created)
    date_modified = property(get_date_modified, set_date_modified)
    date_accessed = property(get_date_accessed, set_date_accessed)

class Footer(object):
    """
    Footer object creates the actual footer used for an include across the site
    when anyone need to automagically generate the HTML for the brand.
    """
    def __init__(self):
        self.id = ""
        self._owner = ""
        self._wordmark = "0"
        self._blockw = "0"
        self._patch = "purple"
        self._sesqui = "0"
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
    def get_sesqui(self):
        return self._sesqui
    def set_sesqui(self, sesqui):
        self._sesqui = sesqui
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
                db = MySQL()
		db.connect()
                db.load("""select footer.id,footer.blockw,footer.patch,footer.sesqui,footer.wordmark from footer WHERE footer.owner='%s' order by footer.created_date DESC""" % (self.owner))
                if len(db.data) > 0:
                    self.id = db.data[0][0]
                    self.blockw = db.data[0][1]
                    self.patch = db.data[0][2]
                    self.sesqui = db.data[0][3]
                    self.wordmark = db.data[0][4]
                    # If cache is turned off, file still generated
                    # to create updated version of cache
                    cache = MyCache(self)
                    cache.dump()
    
    def display_blockw(self):
    	blockw = {'1':'wYes','0':'wNo'}
    	return (blockw[self.blockw])
    	
    def sesqui_cls(self):
        sesqui_sink_cls = {'1':'sesqui','0':''}
        return sesqui_sink_cls[self.sesqui]
        
    def sesqui_link(self):      
        sesqui_sink_link = {'1':'http://www.washington.edu/150/','0':'http://www.washington.edu/discovery/washingtonway/'}
        return sesqui_sink_link[self.sesqui]
        
    def sesqui_tagline(self):       
        sesqui_sink_tagline = {'1':'Together we make history. Discover what\'s next.','0':'Discover what\'s next. It\'s the Washington Way.'}
        return sesqui_sink_tagline[self.sesqui]

    owner = property(get_owner, set_owner)
    wordmark = property(get_wordmark, set_wordmark)
    blockw = property(get_blockw, set_blockw)
    patch = property(get_patch, set_patch)
    sesqui = property(get_sesqui, set_sesqui)
    cache = property(get_cache, set_cache)
    date_created = property(get_date_created, set_date_created)
    date_modified = property(get_date_modified, set_date_modified)
    date_accessed = property(get_date_accessed, set_date_accessed)
