var Utility = {
    BaseUrl : function() {
        var pathparts = location.pathname.split('/');
        
        if (location.host == 'localhost') {
            var url = location.origin+'/'+pathparts[1].trim('/')+'/'; // http://localhost/myproject/
        }else{
            var url = location.origin; // http://stackoverflow.com
        }

        return url;
    }
}