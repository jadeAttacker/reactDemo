/**
 * Created by dw on 2017/6/25.
 */
var comments = [
    {
        "username": "张三",
        "content": "沙发."
    },

    {
        "username": "李四",
        "content": "板凳."
    },

    {
        "username": "王五",
        "content": "地板."
    }
];


var html = '';

$.each(comments , function(commentIndex, comment) {//选择器位置。当前的内容

    html += '<div class="comment"><h6>' + comment['username'] + ':</h6><p class="para">' + comment['content'] + '</p></div>';
});


$('#myAjax').html(html);
