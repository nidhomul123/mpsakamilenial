import{r as v,v as g,m as h,o as d,d as w,j as k,c as C,w as o,b as l,u as r,p as $,e as t,t as s,a as B,n as D}from"./app-a96b9404.js";import{_ as S}from"./ConfirmationModal-80b8e5de.js";import{_ as y}from"./ActionButton-80eb8da3.js";import{_ as N}from"./DangerButton-fb577737.js";import{_ as T}from"./SecondaryButton-f6d0588b.js";import{T as V}from"./index-78a13632.js";import"./Modal-f6002513.js";const j={class:"font-black"},A={__name:"Delete",props:{title:String,member:Object},emits:["open"],setup(f,{emit:u}){const n=f,i=v(!1),a=g({}),_=()=>{var e;a.delete(route("member.destroy",(e=n.member)==null?void 0:e.id),{preserveScroll:!0,onSuccess:()=>c(),onError:()=>null,onFinish:()=>null})},c=()=>{i.value=!1};return(e,p)=>{const b=h("tooltip");return d(),w("div",null,[k((d(),C(y,{variant:"danger",onClick:p[0]||(p[0]=$(m=>(i.value=!0,u("open")),["prevent"]))},{default:o(()=>[l(r(V),{class:"w-4 h-auto"})]),_:1})),[[b,e.lang().label.delete]]),l(S,{show:i.value,onClose:c},{title:o(()=>[t(s(e.lang().label.delete)+" "+s(n.title),1)]),content:o(()=>{var m;return[t(s(e.lang().label.delete_confirm)+" ",1),B("span",j,s((m=n.member)==null?void 0:m.name),1),t("? ")]}),footer:o(()=>[l(T,{onClick:c},{default:o(()=>[t(s(e.lang().button.cancel),1)]),_:1}),l(N,{class:D(["ml-3",{"opacity-25":r(a).processing}]),disabled:r(a).processing,onClick:_},{default:o(()=>[t(s(e.lang().button.delete)+" "+s(r(a).processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])])}}};export{A as default};
