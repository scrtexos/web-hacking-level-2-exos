var page = require('webpage').create();
var system = require('system');
var address;
var nbpage = 0;

if (system.args.length === 1) {
  console.log('Usage: '+system.args[0]+' <some URL>');
  phantom.exit();
}

address = system.args[1];

page.customHeaders = {
  'phantomjs-cheat': '60afe57f665abca1a54cc83955cf3adf0a7db9e5abc8334bf77d4cc1a6fb599a',
};

page.open(address, function(status) {
    console.log("open "+address);
});

page.onLoadFinished = function(status) {
    console.log(page.content);
    console.log('Status: ' + status);
    phantom.exit();
};