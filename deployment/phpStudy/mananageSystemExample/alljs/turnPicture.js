/**
 * Created by dw on 2017/7/11.
 */
window.onload=function () {
    (function () {
        var oDiv=document.getElementsByClassName("turnPictureContainer")[0];
        var oUl=oDiv.getElementsByTagName('ul')[0];
        var oLi=oUl.getElementsByTagName('li');
        // var oImg=oUl.getElementsByTagName('img');
        var oBtn=document.getElementById('btn');
        var oA=oBtn.getElementsByTagName('a');
        var iNow=0;
        var iNow2=0;
        for(var i=0;i<oA.length;i++){
            oA[i].index=i;
            oA[i].onclick=function () {
                for(var i=0;i<oA.length;i++){
                    oA[i].className='';
                }
                this.className="active";
                iNow=this.index;
                oUl.style.left=-700*this.index+"px";
            }
        }
        var timer= setInterval(turn,1000);
        function turn() {
            oUl.style.left=-iNow2*700+"px";
            for(var i=0;i<oA.length;i++){
                oA[i].className='';
            }
            oA[iNow].className="active";
            if (iNow==0){
                oLi[0].style.position="static";
                oUl.style.left=0;
                iNow2=0;
            }
            if(iNow==2){
                oLi[0].style.position="relative";
                oLi[0].style.left=oLi.length*700+'px';
                iNow=0;
            }
            else {
                iNow++;
            }
            iNow2++;
        }
    })();
    var menu=new oMenu('myNotesContainer');
    menu.add('0',['1','2','3']);//json数据，中括号形式。
    menu.add('0_0',['1_1','1_2','1_3']);
    menu.add('0_0_0',['1_1_1','1_1_2','1_1_3']);
    menu.add('0_0_1',['1_2_1','1_2_2','1_2_3']);
    menu.add('0_0_2',['1_3_1','1_3_2','1_3_3']);
    menu.add('0_1',['2_1','2_2','2_3']);
    menu.add('0_1_0',['2_1_1','2_1_2','2_1_3']);
    menu.add('0_1_1',['2_2_1','2_2_2','2_2_3']);
    menu.add('0_1_2',['2_3_1','2_3_2','2_3_3']);
    menu.add('0_2',['3_1','3_2','3_3']);
    menu.add('0_2_0',['3_1_1','3_1_2','3_1_3']);
    menu.add('0_2_1',['3_2_1','3_2_2','3_2_3']);
    menu.add('0_2_2',['3_3_1','3_3_2','3_3_3']);
    menu.init(3);

};
function oMenu(id) {
    this.oParent=document.getElementById(id);
    this.data={};
    this.oSelect=document.getElementsByTagName("select");
}
oMenu.prototype={
    init:function (num) {//默认以及123
        var  This=this;
        for(var i=0;i<num;i++){
            var oSet=document.createElement("select");
            var opt=document.createElement("option");
            opt.innerHTML="默认";
            oSet.appendChild(opt);
            oSet.index=i;
            This.oParent.appendChild(oSet);
            oSet.onchange=function () {
                This.change(this.index);
            };
        };
        this.defaultValue();
    },
    add:function (key,value) {//创建option值
        this.data[key]=value;
    },
    defaultValue:function () {//添加第一个的1，2，3
        var arr=this.data['0'];
        for(var i=0;i<arr.length;i++){
            var opt=document.createElement("option");
            opt.innerHTML=arr[i];
            this.oSelect[0].appendChild(opt);
        }
    },
    change:function(iNow)  {//选择的select,iNow为0，1，2
        var str='0';
        for(var i=0;i<(iNow+1);i++){
            str += '_' + (this.oSelect[i].selectedIndex - 1);
        }//如果iNow=0则str=0_0/1/2,如果iNow=2，str=
        if (this.data[str]) {//前两个select
            this.oSelect[iNow+1].length=1;
            var arr=this.data[str];
            for (var i= 0;i<arr.length; i++) {
                var opt = document.createElement("option");
                opt.innerHTML = this.data[str][i];
                this.oSelect[iNow+1].appendChild(opt);
            }
            this.oSelect[iNow+1].options[1].selected=true;
            this.change(iNow+1);

        }else {
            if(iNow<this.oSelect.length-1){
                for(var i=iNow;i<this.oSelect.length-1;i++){
                    this.oSelect[i+1].options.length=1;
                }
            }
        }
    }
};

