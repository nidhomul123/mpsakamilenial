import{_ as u}from"./DialogModal-02108549.js";import{_}from"./SecondaryButton-f6d0588b.js";import{r as m,s as f,o as v,d as w,a as e,t as a,b as n,w as t,e as i}from"./app-a96b9404.js";import"./index-78a13632.js";import"./Modal-f6002513.js";const h={class:"space-y-2"},x={class:"rounded overflow-hidden"},B={__name:"Properties",props:{title:String,data:Object},setup(c){const o=c,s=m(!1),l=()=>{s.value=!1};return(d,r)=>{const p=f("json-viewer");return v(),w("div",null,[e("div",null,[e("p",{class:"text-primary underline cursor-pointer w-fit",onClick:r[0]||(r[0]=b=>s.value=!0)},a(o.title),1)]),n(u,{show:s.value,onClose:l,"max-width":"xl"},{title:t(()=>[i(a(o.title),1)]),content:t(()=>[e("div",h,[e("div",x,[n(p,{copyable:"",boxed:"",value:o.data},null,8,["value"])])])]),footer:t(()=>[n(_,{onClick:l},{default:t(()=>[i(a(d.lang().button.close),1)]),_:1})]),_:1},8,["show"])])}}};export{B as default};
