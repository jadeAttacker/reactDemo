/**
 * Created by dw on 2018/3/29.
 */
//-1 -2 3 4 -5 -6 7 8
function max(day,num) {

    var sum=1;
    var firstmin=Math.pow(2,day)-1;
    var last=0;
    if(firstmin>num){
        return 0
    }
    while(firstmin<num){
        sum=sum+1;
        last=firstmin;
        firstmin=(Math.pow(2,day)-1)*sum;
        if(firstmin>num){
            return last;
            break;
        }
    }


}


console.log(max(3,7));


function eat(days, num) {

    days=parseInt(days);
    num=parseInt(num);
    if (days === 1) {
        return num;
    }
    var short = Math.floor(num / 2);
    var large = short + Math.floor(short / 2);
    for (var i = large; i >= short; i--) {
        var sumNum = sum(days, i);
        if(sumNum <= num) {
            return i;
        }
    }
}

function sum(days, n) {
    var result = 0;
    for (var i = 0; i < days; i++) {
        result = result + n;
        n = Math.ceil(n / 2);
    }
    return result;
}






/*function score(a,b) {
    var arr=b.split("");
    function sl(c,d) {
        return d-c;
    }
    var a=parseInt(a);
    var score=0;
    var newarr=arr.sort(sl);
    if((parseInt(a)%2)==0){
        for(var i=0;i<a-1;i=i+2){//偶数

            score=score+parseInt(newarr[i])-parseInt(newarr[i+1]);
        }
    }else{//    奇数

        for(var i=0;i<a-2;i=i+2){
            score=score+parseInt(newarr[i])-parseInt(newarr[i+1]);
        }
        score=score+parseInt(newarr[a-1]);
    }
    return score;
}

console.log(score(12,"18358679889 3"));*/
//console.log(8%2)
/*unction sum(n,m) {
   var arr=[];
   var group=parseInt(n/(2*m));
   for(var i=0;i<n;i++){
      arr.push(i)

   }
    console.log(arr);
   for(var i=0;i<group;i++){

   }

}

sum(8,2);*/





























/*function outFn() {
    this.num = 10;
    var age=20;
    function inFn(){
        var num = 100;

        console.log(this.num);  //输出的结果________
        console.log(num);       //输出的结果________
    }
    //return inFn;
}
//outFn()();
var ob=new outFn();
console.log(ob.age)*/









//百度笔试题
/*var  a,b;
while((a=read_line())!=null){
       if((b=read_line())!=null) {
           print(change(b));
       }
}
if((a=read_line())!=null){
    while((b=read_line())!=null){
        print(change(b));
    }
}
while(a=read_line()!=null){
    for(var i=0;i<parseInt(a);i++){
       b=read_line();
       print(change(b))

    }
    break;
}

function change(str) {
    var arr1="0123456789ABCDEFGHIJKLMNOP";
    var arr2="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var newstr=str.replace(/[0-9]/g,"");
    var newPosition="";
    if(newstr=="RC"){
        var indexC=str.indexOf("C");
        var row=str.slice(1,indexC);//23
        var com=parseInt(str.slice(indexC+1)).toString(26).toUpperCase();//55
        for(var i=0;i<com.length;i++){
            newPosition+=arr2[arr1.indexOf(com[i])-1];
        }
        return newPosition+row;
    }else{
        var num=0;
        var com=str.replace(/[0-9]/g,"");//取字母
        var row=str.replace(/[^0-9]/g,"");//取数字
        newPosition=newPosition+"R"+row+"C";
        for(var i=com.length-1;i>=0;i--){//com=BC
            var xishu=(arr2.indexOf(com[i]))+1;
            num=num+xishu*Math.pow(26,(com.length-1-i));
        }
        newPosition+=(num.toString());
        return newPosition
    }

}

console.log(change("BDWFO9999"));
console.log(2*Math.pow(26,4)+4*Math.pow(26,3)+23*Math.pow(26,2)+6*Math.pow(26,1)+15)*/


//给定一个字符串 s，计算具有相同数量0和1的非空(连续)子字符串的数量，并且这些子字符串中的所有0和所有1都是组合在一起的。
//重复出现的子串要计算它们出现的次数。
/*var countBinarySubstrings = function(s) {
     var n=s.length;
     var arr=[];
     var substr="";
     substr+=s[0];
     var num=0;
     for(var i=1;i<n;i++){
         if(s[i]!=s[i-1]){
             arr.push(substr.length);
            substr="";
         }
         substr+=s[i]
         if(i==n-1){
             arr.push(substr.length);
         }

     }
    console.log(arr);
     for(var i=0;i<arr.length-1;i++){
         var min=Math.min.apply(null,[arr[i],arr[i+1]]);
         //console.log(min);
         num=num+min;
     }
     return num;
};
console.log(countBinarySubstrings("10101"));*/






//找不重复的子串
/*var lengthOfLongestSubstring = function(str) {
    var subStr="";
    var substrlenth=[];
    if(str.length<1){
        return str.length;
    }else{
        for(var i=0;i<str.length;i++){
            var index=subStr.indexOf(str[i]);
            if(index<0){
                subStr+=str[i];
                if(i==str.length-1){
                    substrlenth.push(subStr.length);
                }
            }else{
                substrlenth.push(subStr.length);
                subStr=subStr.slice(index+1);
                subStr+=str[i];
            }
        }
        return Math.max.apply(null,substrlenth);
    }

};
console.log(lengthOfLongestSubstring ("a"));*/

/*输入:每组输入数据为两行，第一行为有关约德尔人历史的字符串，第二行是黑默丁格观测星空得到的字符串。
(两个字符串的长度相等,字符串长度不小于1且不超过1000。)
输出:输出一行，在这一行输出相似率。用百分数表示。(相似率为相同字符的个数/总个数,精确到百分号小数点后两位。printf("%%");输出一个%。)
样例输出*/
//var a=read_line();
//var b=read_line();
/*a="@!%1dgsa@!%12dgs@wegb";
b="01010101010111101010";
console.log(a.replace(/[0-9a-z]/i,""));

console.log(a)*/
/*var result=similar(a,b);
//print(result);
console.log(result)
function similar(str1,str2){
    var num=0;
    for(var i=0;i<str1.length;i++){//正则的lastIndex问题！！
        if((/^[0-9a-z]+$/.test(str1[i])&&str2[i]=="1")||(!/^[0-9a-z]+$/.test(str1[i])&&str2[i]=="0")){
            num+=1;
        }
    }
    //console.log((num/str2.length).toFixed(4)*100)
    var result=(100*(num/str2.length)).toFixed(2)+ "%";
    //console.log(result)
    return result
}*/



/*
var str1  = read_line().trim()
var str2 = read_line().trim()
var str = ""
for(var i = 0; i < str1.length; i++) {
    if(/[0-9a-zA-Z]/.test(str1[i])) {

        str += 1;
    } else {

        str +=0;
    }
}
var count = 0;
for(var  k = 0; k < str2.length; k++) {
    if(str2[k] === str[k] ) {
        count++;
    }
}
var result = (100 * count / str2.length).toFixed(2) + "%";
print(result)*/



//数组是否能反转从小到大排序。
/*function findReverse(arr) {
    var left=0;
    var right=0;
    var arr2;
    function sl(a,b) {
        return a-b;
    }
    arr2=arr.slice(0);
    var newArr=arr.sort(sl);
    for(var i=0;i<newArr.length;i++){
        if(newArr[i]!=arr2[i]){
            left=i;
            break;
        }
    }
    for(var i=newArr.length-1;i>=0;i--){
        if(newArr[i]!=arr2[i]){

            right=i;
            break;
        }
    }
    var subarr_a=arr.slice(left,right+1);
    var subarr_b=arr2.slice(left,right+1);
    if (subarr_a.toString()==subarr_b.reverse().toString()){
        console.log("yes")
    }else{
        console.log("no")
    }


}
findReverse([3,1,2,4])

var num=readInt();
var input=[];
for(var i=0;i<num;i++){
    input.push(readInt());
}*/


/*function money(day) {
    if(day==1){
        return 1;
    }else if(day==2){
        return 2;
    }else{
        var cycle=Math.floor(Math.sqrt(2*(day-1)+2.25)-1.5);
       // console.log(cycle);
        var num=0;
        for(var i=0;i<cycle;i++){
            num+=i;
        }
        var rest=day-(cycle+3)*cycle/2;
        return num+rest;
    }
}
console.log(money(15))*/
/*给定一个字符串，找出不含有重复字符的 最长子串 的长度。
示例：
给定 "abcabcbb" ，没有重复字符的最长子串是 "abc" ，那么长度就是3。
给定 "bbbbb" ，最长的子串就是 "b" ，长度是1。
给定 "pwwkew" ，最长子串是 "wke" ，长度是3。请注意答案必须是一个子串，"pwke" 是 子序列 而不是子串。*/
/*var lengthOfLongestSubstring = function(s) {
     var max=0;
     var index=0;
    while(index<s.length){
         var arr=startIndex(s,index);
         console.log(arr);
         index=arr[0];
         if(max<arr[1]){
             max=arr[1];
         }
  }
     return max;


    function startIndex(str,index){
        var subStr="";
        var max=0;
        var t=index;
        for(var i=index;i<str.length;i++){
            if(subStr.indexOf(str[i])<0){
                subStr+=str[i];
                max+=1;
                t=t+1;
            }else{
                break;
            }

        }
        return [t,max];//下次查找位置与当前最大值
    }

};
console.log(lengthOfLongestSubstring("pwwkew"));*/

/*
var twoSum = function(nums, target) {
      var arr=[];
      for(var i=0;i<nums.length;i++){
          var another=target-nums[i];
          if(nums.indexOf(another)>-1&&nums.indexOf(another)!=i){
              arr.push(i);
              arr.push(nums.indexOf(another));
              return arr;
          }

      }
};
console.log(twoSum([3, 2, 4],6));*/
