/**
 * Created by Administrator on 2016/1/18.
 */
$(function(){
    $.ajax({
            url:"scoreBoard.php",
            type:"POST",
        dataType:"json",
        error:function(){
            alert("数据返回失败！");
        },
        success: function(data,testStatus){
            var  $tabBox=$(".tabBox");
            $tabBox.append(data.jsmsTable);
            $tabBox.append(data.szmsTable);
            $(".tabBox tr:odd").addClass("odd");
            $(".tabBox tr:even").addClass("even");
            }

        });
var $div_li=$(".tabMenu li");
    $div_li.click(function(){
        $(this).addClass("selected")
            .siblings().removeClass("selected");
        var index=$div_li.index(this);
        var $target=$(".tabBox>table").eq(index);
        $target.siblings().fadeOut(80,function(){
            $target.fadeIn(80);
            });

    })
});