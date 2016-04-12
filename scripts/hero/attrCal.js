/**
 * Created by Administrator on 2016/1/17.
 */
var health_add = 1.700000*19;
var mana_add = 4.000000*13;
var armor_add = 1.900000/7;
var health_init = 150+19*19;
var mana_init = 22*13;
var attack_min = 13;
var attack_max = 19;
var attack_min_init = 0;
var attack_max_init = 0;
var as_init = 1.700000/(1+1.900000/100);
var attack_gain = 0;
var attack_rate = 1.700000;
var armor_init = -1+20/7;
var main_attr= 0;
if ('DOTA_ATTRIBUTE_INTELLECT' == 'DOTA_ATTRIBUTE_INTELLECT') {
    main_attr = 3;
    attack_gain = 4.000000;
    attack_min_init = attack_min + 22;
    attack_max_init = attack_max + 22;
}
else {
    if ('DOTA_ATTRIBUTE_INTELLECT' == 'DOTA_ATTRIBUTE_STRENGTH') {
        main_attr= 1;
        attack_gain = 1.700000;
        attack_min_init = attack_min + 19;
        attack_max_init = attack_max + 19;
    } else {
        main_attr= 2;
        attack_gain = 1.900000;
        attack_min_init = attack_min + 20;
        attack_max_init = attack_max + 20;
    }
}
$(function() {
    $( "#slider" ).slider({
        range: "max",
        min: 1,
        max: 25,
        value: 1,
        slide: function( event, ui ) {
            var as_now = 1.700000/(1+ (1.900000+1.900000*(ui.value-1))/100);
            $("#amount").val(ui.value);
            $("#level").text(ui.value);
            $("#str").text( Math.round(19 + 1.700000*(ui.value-1)));
            $("#int").text( Math.round(22 + 4.000000*(ui.value-1)));
            $("#agi").text( Math.round(20 + 1.900000*(ui.value-1)));
            $("#attack").text(String(Math.round(attack_min_init+attack_gain*(ui.value-1)))+" - "+String(Math.round(attack_max_init+attack_gain*(ui.value-1))));
            $("#health").text(Math.round(health_init+health_add*(ui.value-1)));
            $("#mana").text(Math.round(mana_init+mana_add*(ui.value-1)));
            $("#armor").text((armor_init+armor_add*(ui.value-1)).toFixed(1));
            $("#dps").text( String(Math.round((1/as_now)*((attack_min_init+attack_max_init)/2 + attack_gain*(ui.value-1) ))) + " ("+ String((as_now).toFixed(2)) +")" ) ;
            myNewRadar.datasets[0].points[0].value = 40+(ui.value-1)*2;
            myNewRadar.datasets[0].points[1].value = 20+(ui.value-1)*1.6;
            myNewRadar.datasets[0].points[2].value = 40+(ui.value-1)*1.2;
            myNewRadar.datasets[0].points[3].value = 15+(ui.value-1)*1;
            myNewRadar.datasets[0].points[4].value = 40+(ui.value-1)*2.2;
            myNewRadar.update();
        }
    });
    $("#amount").val( $( "#slider-range-max" ).slider( "value" ) );
    $("#dps").text( String(Math.round( (1/as_init)*((attack_min_init+attack_max_init)/2))) + " ("+ String((as_init).toFixed(2)) +")" ) ;
    $("#armor").text(armor_init.toFixed(1));
    $("#health").text(health_init);
    $("#mana").text(mana_init);
    $("#attack").text(String(attack_min_init)+" - "+String(attack_max_init));

var ctx= $("#basicRight").get(0).getContext("2d");
    var data = {
        labels: ["输出",  "辅助", "逃生", "肉盾","控制"],
        datasets: [
            {
                label: "My dataset",
                fillColor: "rgba(151,187,205,0.6)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [45, 20, 30, 15, 45]
            }
        ]
    };
    var myNewRadar = new Chart(ctx).Radar(data,{
        pointLabelFontSize : 20,
        pointLabelFontFamily :  "Microsoft Yahei",
        pointLabelFontColor : "white",
        angleLineColor:"#ccc",
        scaleLineColor: "#ccc",
        showTooltips: false,
        pointDot : false,
        scaleOverride : true,
        scaleShowGridLines : false,
        scaleSteps : 4,   //这两项必须同时设置才能生效
        scaleStepWidth : 25

    });

});