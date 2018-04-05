/**
 * Created by dw on 2017/7/12.
 */
function addPrice(url,callback,async) {
    var xmlhttp;
    var data=[];
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function()
    {
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
        {
           data=callback(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET",url,async);
    xmlhttp.send();
    return data;
}
function test(arg) {
    var json = eval('(' + arg + ')');
    return json.list;
    console.log(json.list);
}
//对象
function Calendar(obj,opt1,opt2){
    this.oObj=document.getElementById(obj);
    this.oDiv=document.getElementById(opt1);
    this.oDiv2=document.getElementById(opt2);
    this.oChooseDate=document.getElementsByClassName("date")[0];
    this.oPrice=document.getElementsByClassName("price")[0];
    this.oBtn2=true;
}

Calendar.prototype={
    init:function (year,month){//2017.7
        if(month==12){
            this.add(this.oDiv,year,month,true);
          /*  */
            this.add(this.oDiv2,year+1,1,false);
        }else {
                this.add(this.oDiv,year,month,true);//2017.7
                this.add(this.oDiv2,year,month+1,false);//2017.8
        }
        this.listener();
        if (year==new Date().getFullYear()&&month==new Date().getMonth()+1){
            this.showColor(new Date().getDate());
        }
        this.hidden();
    },
    add:function (opt,year,month,oBtn) {
        var day=this.dayNum(year,month);//获取本年本月天数，按数字判断的。
        var fistWeekday=(new Date(year,month-1,1)).getDay();//传递参数是7，让它减1;
        //添加title
        var  oTitle=document.createElement("div");
        oTitle.className="title";
        if(oBtn){
            oTitle.innerHTML="<div class='l'><span>"+(month-1)+"</span>月</div><div class='year'><span>"+year
                +"</span>年<span>"+month+"</span>月</div>";
        }else {
            oTitle.innerHTML="<div class='year'><span>"+year
                +"</span>年<span>"+month+"</span>月</div><div class='r'><span>"+(month+1)+"</span>月</div>";
        }
        //添加table（thead，tbody）
        var oTable=document.createElement("table");
        var oThead=document.createElement("thead");
        var oTr=document.createElement("tr");
        var oTbody=document.createElement("tbody");
        var arr=['周一','周二','周三','周四','周五','周六','周日'];
        for (var i=0;i<arr.length;i++){
            var oTh=document.createElement("th");
            oTh.innerHTML=arr[i];
            if(i==5||i==6){
                oTh.className="red";
            }
            oTr.appendChild(oTh);
        }
        oThead.appendChild(oTr);
        oTable.appendChild(oThead);
        for (var i=0;i<6;i++){
            var oTr=document.createElement("tr");
            for (var j=0;j<7;j++){
                var oTd=document.createElement("td");
                oTr.appendChild(oTd);
                oTd.innerHTML=""
            }
            oTbody.appendChild(oTr);
        }
        var td=oTbody.getElementsByTagName("td");

        switch(fistWeekday) {
                case 0:{
                    for(var i=0;i<day;i++){
                        td[i+6].innerHTML=i+1;
                    }
                    break;
                }
                case 1:{
                    for(var i=0;i<day;i++){
                        td[i].innerHTML=i+1;
                    }
                    break;
                }
                case 2:{
                    for(var i=0;i<day;i++){
                        td[i+1].innerHTML=i+1;
                    }
                    break;
                }
                case 3:{
                    for(var i=0;i<day;i++){
                        td[i+2].innerHTML=i+1;
                    }
                    break;
                }
                case 4:{
                    for(var i=0;i<day;i++){
                        td[i+3].innerHTML=i+1;
                    }
                    break;
                }
                case 5:{
                    for(var i=0;i<day;i++){
                        td[i+4].innerHTML=i+1;
                    }
                    break;
                }
                case 6:{
                    for(var i=0;i<day;i++){
                        td[i+5].innerHTML=i+1;
                    }
                    break;
                }
        }
        oTable.appendChild(oTbody);
        opt.appendChild(oTitle);
        opt.appendChild(oTable);
    },
    dayNum:function (year,month) {
        var dayNum = '';
        if (month == 1 || month == 3 || month == 5 || month == 7 || month == 8 || month == 10 || month == 12) {
            dayNum = 31;
        } else if (month == 4 || month == 6 || month == 9 || month == 11) {
            dayNum = 30
        } else {
            dayNum = this.yearJudge(year);
        }
        return dayNum;
    },
    yearJudge:function (year) {
        if (year%4==0&&year%100!==0){
            return 29;
        }else if(year%400==0){
            return 29;
        }else {return 28;}
    },
    showColor:function (data) {
        var myData=addPrice("./huaweipicture/price.txt",test,false);
        var getTd=this.oObj.getElementsByTagName("td");
        var This=this;
        var re=new RegExp(''+data+'(</p>)*');
        var arr=[];
        for(var i=0;i<getTd.length;i++){//有值的td数组
            getTd[i].index=i;
            if (getTd[i].innerHTML!==""){
                var  oP=document.createElement("p");
                oP.className="alsored";
                oP.innerHTML=myData[i];
                getTd[i].appendChild(oP);
                arr.push(getTd[i]);
            }
        }
        for(var i=0;i<arr.length;i++){//给当天数据加颜色,小bug。
                if (arr[i].index<42){
                    //需要一个正则匹配。if判断在哪边。
                    if (re.test(arr[i].innerHTML)){
                        arr[i].className="red";
                        arr[i].onclick=function () {
                            var date=parseInt(this.innerHTML.slice(0,2));
                            This.addData(This.oChooseDate,This.oPrice,date,2);//把p标签的内容填为价格，日期从span取得。
                        };
                        for (var j=1;j<11;j++){
                            arr[i+j].className="blue";
                            arr[i+j].onclick=function () {
                                if(this.index<42){
                                    This.addData(This.oChooseDate,This.oPrice,"还没有","注册呢");
                                }else {
                                    This.addData(This.oChooseDate,This.oPrice,"要注意","下月啦");
                                }

                            }
                        }
                    }
                }
        }
    },
    listener:function () {
        this.leftSpan=this.oDiv.getElementsByTagName("span");
        this.rightSpan=this.oDiv2.getElementsByTagName("span");
        console.log(this.leftSpan[0].innerHTML);
        console.log(this.leftSpan[1].innerHTML);
        console.log(this.leftSpan[2].innerHTML);
        var This=this;
        this.leftSpan[0].parentNode.onclick=function () {
            This.oChooseDate.value="";
            This.oPrice.value="";
            var nowYear=This.leftSpan[1].innerHTML;
            var nowMouth=This.leftSpan[2].innerHTML;
            This.oDiv.innerHTML='';
            This.oDiv2.innerHTML='';
            if(nowMouth==2){
                This.init(parseInt(nowYear),1);
                This.leftSpan[0].innerHTML=12;
            }else if(nowMouth==1){
                This.init(parseInt(--nowYear),12);
            }else if (nowMouth==12){
                This.init(parseInt(nowYear),--nowMouth);
                This.rightSpan[2].innerHTML=1;
            } else {
                This.init(parseInt(nowYear),--nowMouth);
            }
        };
        this.rightSpan[2].parentNode.onclick=function () {
            This.oChooseDate.value="";
            This.oPrice.value="";
            var nowYear=This.leftSpan[1].innerHTML;
            var nowMouth=This.leftSpan[2].innerHTML;
            This.oDiv.innerHTML='';
            This.oDiv2.innerHTML='';
             if(nowMouth==10){
                 This.init(parseInt(nowYear),++nowMouth);
                 This.rightSpan[2].innerHTML=1;
            }else if (nowMouth==12){
                 This.init(parseInt(++nowYear),1);
                 This.leftSpan[0].innerHTML=12;
             }
             else{
                 This.init(parseInt(nowYear),++nowMouth)
             }
        }
    },
    addData:function (arg1,arg2,date,price) {
        arg1.value=date;
        arg2.value=price;
        this.oObj.style.display="none";
        this.oBtn2=!this.oBtn2;
    },
    hidden:function () {
        this.judgeNull(35,42);
        this.judgeNull(77,84);
    },
    judgeNull:function (arg1,arg2) {
        var getTd=this.oObj.getElementsByTagName("td");
        var content=[];
        for (var i=arg1;i<arg2;i++){
            content.push(getTd[i].innerHTML);
        }
        var con=content.join('');
        if(con.length==0){
            for (var i=arg1;i<arg2;i++){
                getTd[i].style.display="none";
            }
        }
    }

};
