import{r as b,v as h,q as w,m as k,o as f,d as C,j as B,c as D,w as s,b as n,u as r,p as I,e as i,t as e,n as S}from"./app-a96b9404.js";import{_ as $}from"./ConfirmationModal-80b8e5de.js";import{_ as m}from"./DangerButton-fb577737.js";import{_ as y}from"./SecondaryButton-f6d0588b.js";import{T as E}from"./index-78a13632.js";import"./Modal-f6002513.js";const z={__name:"DeleteBulk",props:{title:String,selectedId:Object},emits:["close"],setup(p,{emit:_}){const o=p,a=b(!1),t=h({id:[]});w(()=>{a&&(t.id=o.selectedId)});const g=()=>{t.post(route("grade.destroy-bulk"),{preserveScroll:!0,onSuccess:()=>{c(),_("close")},onError:()=>null,onFinish:()=>null})},c=()=>{a.value=!1};return(l,u)=>{const v=k("tooltip");return f(),C("div",null,[B((f(),D(m,{class:"rounded-none",onClick:u[0]||(u[0]=I(d=>a.value=!0,["prevent"]))},{default:s(()=>[n(r(E),{class:"w-4 h-auto"})]),_:1})),[[v,l.lang().label.delete_selected]]),n($,{show:a.value,onClose:c},{title:s(()=>[i(e(l.lang().label.delete_selected)+" "+e(o.title),1)]),content:s(()=>{var d;return[i(e(l.lang().label.delete_confirm)+" "+e((d=o.selectedId)==null?void 0:d.length)+" "+e(o.title)+"? ",1)]}),footer:s(()=>[n(y,{onClick:c},{default:s(()=>[i(e(l.lang().button.cancel),1)]),_:1}),n(m,{class:S(["ml-3",{"opacity-25":r(t).processing}]),disabled:r(t).processing,onClick:g},{default:s(()=>[i(e(l.lang().button.delete)+" "+e(r(t).processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])])}}};export{z as default};
