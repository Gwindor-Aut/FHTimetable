#!/usr/bin/node
var now = new Date().toString().replace(/ GMT.[a-zäöü ()0-9A-Z]*/, '');
console.log("[STARTUP] ["+now+"] - Server is starting");


var theapp = require('./controller/master.js');
console.log("[STARTUP] ["+now+"] - NewTimetableServer loading");
theapp.startup();
console.log('[INFO] ['+now+'] written by: ' + theapp.author);
console.log('[INFO] ['+now+'] Version: ' + theapp.vers);