import{r as g,v,o as h,d as C,b as s,w as a,u as o,a as i,t,p,e as c,n as w}from"./app-a96b9404.js";import{_ as k}from"./DialogModal-02108549.js";import{_ as $}from"./InputError-9f6d638b.js";import{_ as y}from"./InputLabel-aac3b093.js";import{_ as f}from"./PrimaryButton-aac607c9.js";import{_ as S}from"./SecondaryButton-f6d0588b.js";import{_ as V}from"./TextInput-c0b06f0e.js";import{P as N}from"./index-78a13632.js";import"./Modal-f6002513.js";const B={class:"hidden md:block"},x=["onSubmit"],E={class:"space-y-1"},q={__name:"Create",props:{title:String},setup(_){const b=_,l=g(!1),e=v({name:""}),u=()=>{e.post(route("comment.store"),{preserveScroll:!0,onSuccess:()=>m(),onError:()=>null,onFinish:()=>null})},m=()=>{l.value=!1,e.errors={},e.reset()};return(n,r)=>(h(),C("div",null,[s(f,{class:"flex rounded-none items-center justify-start gap-2",onClick:r[0]||(r[0]=p(d=>l.value=!0,["prevent"]))},{default:a(()=>[s(o(N),{class:"w-4 h-auto"}),i("span",B,t(n.lang().button.add),1)]),_:1}),s(k,{show:l.value,onClose:m},{title:a(()=>[c(t(n.lang().label.add)+" "+t(b.title),1)]),content:a(()=>[i("form",{class:"space-y-2",onSubmit:p(u,["prevent"])},[i("div",E,[s(y,{for:"name",value:"Comment Name"}),s(V,{id:"name",modelValue:o(e).name,"onUpdate:modelValue":r[1]||(r[1]=d=>o(e).name=d),type:"text",class:"block w-full",autocomplete:"name",placeholder:"Comment Name",error:o(e).errors.name},null,8,["modelValue","error"]),s($,{message:o(e).errors.name},null,8,["message"])])],40,x)]),footer:a(()=>[s(S,{onClick:m},{default:a(()=>[c(t(n.lang().button.cancel),1)]),_:1}),s(f,{class:w(["ml-3",{"opacity-25":o(e).processing}]),disabled:o(e).processing,onClick:u},{default:a(()=>[c(t(n.lang().button.save)+" "+t(o(e).processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{q as default};