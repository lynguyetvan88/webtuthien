new Date() // current date and time
new Date(milliseconds) //milliseconds since 1970/01/01
new Date(dateString)
new Date(year, month, day, hours, minutes, seconds, milliseconds)
var today = new Date()
var d1 = new Date("October 13, 1975 11:13:00")
var d2 = new Date(79,5,24)
var d3 = new Date(79,5,24,11,33,0)
var myDate=new Date();
myDate.setFullYear(2010,0,14);
var myDate=new Date();
myDate.setDate(myDate.getDate()+5);
var x=new Date();
x.setFullYear(2100,0,14);
var today = new Date();

if (x>today)
  {
  alert("Today is before 14th January 2100");
  }
else
  {
  alert("Today is after 14th January 2100");
  }