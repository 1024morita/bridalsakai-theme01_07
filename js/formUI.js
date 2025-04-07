// Copyright (c) 2013 Keith Perhac @ DelfiNet (http://delfi-net.com)
//
// Based on the AutoRuby library created by:
// Copyright (c) 2005-2008 spinelz.org (http://script.spinelz.org/)
//
// https://github.com/harisenbon/autokana/
//
// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do so, subject to
// the following conditions:
//
// The above copyright notice and this permission notice shall be
// included in all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
// LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
// OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

!function(n){n.fn.autoKana=function(t,e,a){function i(n){if(!E)if(Math.abs(k.length-n.length)>1){var t=n.join("").replace(m,"").split("");Math.abs(k.length-t.length)>1&&v()}else k.length==d.length&&k.join("")!=d&&d.match(C)&&v()}function r(){var n,t;if(""==(n=p.val()))g(),c();else{if(n=l(n),d==n)return;d=n,E||(i(t=n.replace(C,"").split("")),c(t))}}function f(){clearInterval(A)}function o(n){return n>=12353&&n<=12435||12445==n||12446==n}function l(n){if(-1!==n.indexOf(w))return n.replace(w,"");var t,e,a;for(e=w.split(""),a=n.split(""),t=0;t<e.length;t++)e[t]==a[t]&&(a[t]="");return a.join("")}function u(){A=setInterval(r,30)}function c(n){if(!E&&(n&&(k=n),y)){var t=s(x+k.join(""));j.val(t)}}function g(){x="",E=!1,w="",d="",k=[]}function h(){x=j.val(),E=!1,w=p.val()}function v(){x+=k.join(""),E=!0,k=[]}function s(n){if(b.katakana){var t,e,a;for(a=new String,e=0;e<n.length;e++)o(t=n.charCodeAt(e))?a+=String.fromCharCode(t+96):a+=n.charAt(e);return a}return n}var p,j,d,k,w,x,b=n.extend({katakana:!1},a),C=new RegExp("[^ 　ぁあ-んー]","g"),m=new RegExp("[ぁぃぅぇぉっゃゅょ]","g"),y=!1,A=null,E=!0;p=n(t),j=n(e),y=!0,g(),p.blur(function(n){f()}),p.focus(function(n){h(),u()}),p.keydown(function(n){E&&h()})}}(jQuery);

jQuery(function($){
    //katakana: false = ふりがな, true = カタカナ
    $.fn.autoKana('#your_name', '#your_kana', {katakana:true});
});



//zip search
/* ================================================================ *
    ajaxzip3.js ---- AjaxZip3 郵便番号→住所変換ライブラリ

    Copyright (c) 2008-2015 Ninkigumi Co.,Ltd.
    http://ajaxzip3.github.io/

    Copyright (c) 2006-2007 Kawasaki Yusuke <u-suke [at] kawa.net>
    http://www.kawa.net/works/ajax/AjaxZip2/AjaxZip2.html

    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
* ================================================================ */

AjaxZip3=function(){};AjaxZip3.VERSION="0.51";AjaxZip3.JSONDATA="https://yubinbango.github.io/yubinbango-data/data";AjaxZip3.CACHE=[];AjaxZip3.prev="";AjaxZip3.nzip="";AjaxZip3.fzip1="";AjaxZip3.fzip2="";AjaxZip3.fpref="";AjaxZip3.addr="";AjaxZip3.fstrt="";AjaxZip3.farea="";AjaxZip3.ffocus=true;AjaxZip3.onSuccess=null;AjaxZip3.onFailure=null;AjaxZip3.PREFMAP=[null,"北海道","青森県","岩手県","宮城県","秋田県","山形県","福島県","茨城県","栃木県","群馬県","埼玉県","千葉県","東京都","神奈川県","新潟県","富山県","石川県","福井県","山梨県","長野県","岐阜県","静岡県","愛知県","三重県","滋賀県","京都府","大阪府","兵庫県","奈良県","和歌山県","鳥取県","島根県","岡山県","広島県","山口県","徳島県","香川県","愛媛県","高知県","福岡県","佐賀県","長崎県","熊本県","大分県","宮崎県","鹿児島県","沖縄県"];AjaxZip3.zip2addr=function(h,g,k,b,l,a,m){AjaxZip3.fzip1=AjaxZip3.getElementByName(h);AjaxZip3.fzip2=AjaxZip3.getElementByName(g,AjaxZip3.fzip1);AjaxZip3.fpref=AjaxZip3.getElementByName(k,AjaxZip3.fzip1);AjaxZip3.faddr=AjaxZip3.getElementByName(b,AjaxZip3.fzip1);AjaxZip3.fstrt=AjaxZip3.getElementByName(a,AjaxZip3.fzip1);AjaxZip3.farea=AjaxZip3.getElementByName(l,AjaxZip3.fzip1);AjaxZip3.ffocus=m===undefined?true:m;if(!AjaxZip3.fzip1){return}if(!AjaxZip3.fpref){return}if(!AjaxZip3.faddr){return}var c=AjaxZip3.fzip1.value;if(AjaxZip3.fzip2&&AjaxZip3.fzip2.value){c+=AjaxZip3.fzip2.value}if(!c){return}AjaxZip3.nzip="";for(var f=0;f<c.length;f++){var d=c.charCodeAt(f);if(d<48){continue}if(d>57){continue}AjaxZip3.nzip+=c.charAt(f)}if(AjaxZip3.nzip.length<7){return}var j=function(){var i=AjaxZip3.nzip+AjaxZip3.fzip1.name+AjaxZip3.fpref.name+AjaxZip3.faddr.name;if(AjaxZip3.fzip1.form){i+=AjaxZip3.fzip1.form.id+AjaxZip3.fzip1.form.name+AjaxZip3.fzip1.form.action}if(AjaxZip3.fzip2){i+=AjaxZip3.fzip2.name}if(AjaxZip3.fstrt){i+=AjaxZip3.fstrt.name}if(i==AjaxZip3.prev){return}AjaxZip3.prev=i};var n=AjaxZip3.nzip.substr(0,3);var e=AjaxZip3.CACHE[n];if(e){return AjaxZip3.callback(e)}AjaxZip3.zipjsonpquery()};AjaxZip3.callback=function(h){function d(){if(typeof AjaxZip3.onFailure==="function"){AjaxZip3.onFailure()}}var m=h[AjaxZip3.nzip];var e=(AjaxZip3.nzip-0+4278190080)+"";if(!m&&h[e]){m=h[e]}if(!m){d();return}var b=m[0];if(!b){d();return}var o=AjaxZip3.PREFMAP[b];if(!o){d();return}var c=m[1];if(!c){c=""}var r=m[2];if(!r){r=""}var f=m[3];if(!f){f=""}var q=AjaxZip3.faddr;var k=c;if(AjaxZip3.fpref.type=="select-one"||AjaxZip3.fpref.type=="select-multiple"){var a=AjaxZip3.fpref.options;for(var g=0;g<a.length;g++){var n=a[g].value;var p=a[g].text;a[g].selected=(n==b||n==o||p==o)}}else{if(AjaxZip3.fpref.name==AjaxZip3.faddr.name){k=o+k}else{AjaxZip3.fpref.value=o}}if(AjaxZip3.farea){q=AjaxZip3.farea;AjaxZip3.farea.value=r}else{k+=r}if(AjaxZip3.fstrt){q=AjaxZip3.fstrt;if(AjaxZip3.faddr.name==AjaxZip3.fstrt.name){k=k+f}else{if(f){AjaxZip3.fstrt.value=f}}}AjaxZip3.faddr.value=k;if(typeof AjaxZip3.onSuccess==="function"){AjaxZip3.onSuccess()}if(!AjaxZip3.ffocus){return}if(!q){return}if(!q.value){return}var l=q.value.length;q.focus();if(q.createTextRange){var j=q.createTextRange();j.move("character",l);j.select()}else{if(q.setSelectionRange){q.setSelectionRange(l,l)}}};AjaxZip3.getResponseText=function(b){var c=b.responseText;if(navigator.appVersion.indexOf("KHTML")>-1){var a=escape(c);if(a.indexOf("%u")<0&&a.indexOf("%")>-1){c=decodeURIComponent(a)}}return c};AjaxZip3.getElementByName=function(d,b){if(typeof(d)=="string"){var e=document.getElementsByName(d);if(!e){return null}if(e.length>1&&b&&b.form){var c=b.form.elements;for(var a=0;a<c.length;a++){if(c[a].name==d){return c[a]}}}else{return e[0]}}return d};AjaxZip3.zipjsonpquery=function(){var a=AjaxZip3.JSONDATA+"/"+AjaxZip3.nzip.substr(0,3)+".js";var b=document.createElement("script");b.setAttribute("type","text/javascript");b.setAttribute("charset","UTF-8");b.setAttribute("src",a);document.getElementsByTagName("head").item(0).appendChild(b)};function $yubin(a){AjaxZip3.callback(a)};

window.onload = function() {
	const window_w = window.innerWidth;
	const your_phone = document.querySelector('#your_phone');
	if(your_phone !== null){
		your_phone.onblur = function(){ adjust_phone_num(your_phone) };
	}
	const your_fax = document.querySelector('#your_fax');
	if(your_fax !== null){
		your_fax.onblur = function(){ adjust_phone_num(your_fax) };
	}
	const zipcode = document.querySelector('#zipcode');
	if(zipcode !== null){
		zipcode.onblur = function(){
			adjust_phone_num(zipcode);
			AjaxZip3.zip2addr('zipcode','','pref','address');
		};
	}
	function adjust_phone_num(dom){
		dom.value = dom.value.replace(/[‐－―ー]/g, "-").replace(/[～〜]/g, "~").replace(/　/g, " ");
		dom.value = dom.value.replace(/[Ａ-Ｚａ-ｚ０-９]/g, function(s) {
			return String.fromCharCode(s.charCodeAt(0) - 0xFEE0);
		})
		return dom;
	}
	if(window_w < 800 && your_phone !== null || your_fax !== null){
		if(your_phone !== null){
			your_phone.setAttribute("type", "tel");
		}
		if(your_fax !== null){
			your_fax.setAttribute("type", "tel");
		}
	}
}

jQuery(function ($) {
    const set_datepicker_dom = $("#reserve_day1, #reserve_day2, #reserve_day3");
	if(set_datepicker_dom.length !== 0){
		const today = new Date();
		const target_day = today.setDate(today.getDate() + 1);
		set_datepicker_dom.datepicker({
			dateFormat: "yy年mm月dd日",
			monthNames: [
				"1月",
				"2月",
				"3月",
				"4月",
				"5月",
				"6月",
				"7月",
				"8月",
				"9月",
				"10月",
				"11月",
				"12月"
			],
			monthNamesShort: [
				"1月",
				"2月",
				"3月",
				"4月",
				"5月",
				"6月",
				"7月",
				"8月",
				"9月",
				"10月",
				"11月",
				"12月"
			],
			dayNamesShort: ["日", "月", "火", "水", "木", "金", "土"],
			dayNamesMin: ["日", "月", "火", "水", "木", "金", "土"],
			minDate: new Date(target_day),
			regional: "ja",
		});//初期化

		// set_datepicker_dom.datepicker(
		//     'option', 'beforeShowDay',function(date){
		//         let ret = date.getDay() !== 3;
		//         if(ret){
		//             return [true];
		//         }else{
		//             return [false];
		//         }
		//     }
		// );
		set_datepicker_dom.attr('readonly', true);
	}
});
