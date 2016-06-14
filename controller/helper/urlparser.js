UrlParser = function(url){
    this.url=url;
    this.path="";
    this.resource="";
    this.id=null;
    this.format="";
    this.controller="";
    
    this.parse();
}

UrlParser.prototype.parse=function(){
	var reqtime = new Date().toString().replace(/ GMT.[a-zäöü ()0-9A-Z]*/, '');
    parts = this.url.split('/');
    console.log(parts);
    if(this.url=="/rest/images"){
        this.controller="ImageController"
    } else {
        this.controller="StaticController"
    }
}

module.exports.UrlParser=UrlParser;