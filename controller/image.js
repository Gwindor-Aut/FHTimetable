var fs = require('fs');

var ImageController=function(){

}

ImageController.prototype.handle=function (res, req) {
    var reqtime = new Date().toString().replace(/ GMT.[a-zäöü ()0-9A-Z]*/, '');
    console.log("[INFO] ["+reqtime+"] ImageController Handeling Request");
    res.writeHead(200, {'content-Type': 'text/html'});
    	fs.readFile('./model/index.html', function(err, data){
	if (err){
		console.log(err);
		res.end("404 - File not found");
	} else {
		utf8data=data.toString('UTF-8');
		res.write(utf8data);
		res.end('\n(c) Florian Schweighofer\n');
		}
		
	})
}

module.exports.ImageController = ImageController;