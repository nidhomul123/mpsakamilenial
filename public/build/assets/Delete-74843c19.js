import{r as v,v as b,m as g,o as m,d as h,j as w,c as k,w as s,b as n,u as l,p as C,e as o,t,n as $,a as y}from"./app-a96b9404.js";import{_ as B}from"./ConfirmationModal-80b8e5de.js";import{_ as D}from"./ActionButton-80eb8da3.js";import{_ as S}from"./DangerButton-fb577737.js";import{_ as q}from"./SecondaryButton-f6d0588b.js";import{T as N}from"./index-78a13632.js";import"./Modal-f6002513.js";const T=y("span",{class:"font-black"},"pertanyaan ini",-1),A={__name:"Delete",props:{title:String,question:Object},emits:["open"],setup(u,{emit:d}){const c=u,r=v(!1),a=b({}),f=()=>{var e;a.delete(route("question.destroy",(e=c.question)==null?void 0:e.id),{preserveScroll:!0,onSuccess:()=>i(),onError:()=>null,onFinish:()=>null})},i=()=>{r.value=!1};return(e,p)=>{const _=g("tooltip");return m(),h("div",null,[w((m(),k(D,{variant:"danger",onClick:p[0]||(p[0]=C(V=>(r.value=!0,d("open")),["prevent"]))},{default:s(()=>[n(l(N),{class:"w-4 h-auto"})]),_:1})),[[_,e.lang().label.delete]]),n(B,{show:r.value,onClose:i},{title:s(()=>[o(t(e.lang().label.delete)+" "+t(c.title),1)]),content:s(()=>[o(t(e.lang().label.delete_confirm)+" ",1),T,o("? ")]),footer:s(()=>[n(q,{onClick:i},{default:s(()=>[o(t(e.lang().button.cancel),1)]),_:1}),n(S,{class:$(["ml-3",{"opacity-25":l(a).processing}]),disabled:l(a).processing,onClick:f},{default:s(()=>[o(t(e.lang().button.delete)+" "+t(l(a).processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])])}}};export{A as default};
