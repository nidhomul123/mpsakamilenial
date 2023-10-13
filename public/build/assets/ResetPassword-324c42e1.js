import{v as w,o as _,d as g,b as o,u as e,X as b,w as n,a as l,t as i,n as h,e as v,p as V,F as k}from"./app-a96b9404.js";import{_ as y}from"./AuthenticationCard-bf5a1d06.js";import{_ as $}from"./AuthenticationCardLogo-d790809c.js";import{_ as m}from"./InputError-9f6d638b.js";import{_ as d}from"./InputLabel-aac3b093.js";import{_ as S}from"./PrimaryButton-aac607c9.js";import{_ as p}from"./TextInput-c0b06f0e.js";import"./SwitchDarkMode-538c7276.js";import"./index-78a13632.js";import"./ApplicationLogo-ad1997ea.js";import"./_plugin-vue_export-helper-c27b6911.js";const q={class:"flex flex-col mb-4"},B={class:"text-primary font-semibold text-xl"},F={class:"text-slate-400"},N=["onSubmit"],U={class:"mt-4"},C={class:"mt-4"},j={class:"flex items-center justify-end mt-4"},H={__name:"ResetPassword",props:{email:String,token:String},setup(c){const u=c,s=w({token:u.token,email:u.email,password:"",password_confirmation:""}),f=()=>{s.post(route("password.update"),{onFinish:()=>s.reset("password","password_confirmation")})};return(a,r)=>(_(),g(k,null,[o(e(b),{title:a.lang().label.reset_password},null,8,["title"]),o(y,null,{logo:n(()=>[o($)]),default:n(()=>[l("div",q,[l("h2",B,i(a.lang().label.reset_password),1),l("small",F,i(a.lang().label.reset_password_caption),1)]),l("form",{onSubmit:V(f,["prevent"])},[l("div",null,[o(d,{for:"email",value:a.lang().label.email},null,8,["value"]),o(p,{id:"email",modelValue:e(s).email,"onUpdate:modelValue":r[0]||(r[0]=t=>e(s).email=t),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username",placeholder:a.lang().placeholder.email,error:e(s).errors.email},null,8,["modelValue","placeholder","error"]),o(m,{class:"mt-2",message:e(s).errors.email},null,8,["message"])]),l("div",U,[o(d,{for:"password",value:a.lang().label.password},null,8,["value"]),o(p,{id:"password",modelValue:e(s).password,"onUpdate:modelValue":r[1]||(r[1]=t=>e(s).password=t),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password",placeholder:a.lang().placeholder.password,error:e(s).errors.password},null,8,["modelValue","placeholder","error"]),o(m,{class:"mt-2",message:e(s).errors.password},null,8,["message"])]),l("div",C,[o(d,{for:"password_confirmation",value:a.lang().label.confirm_password},null,8,["value"]),o(p,{id:"password_confirmation",modelValue:e(s).password_confirmation,"onUpdate:modelValue":r[2]||(r[2]=t=>e(s).password_confirmation=t),type:"password",class:"mt-1 block w-full",required:"",autocomplete:"new-password",placeholder:a.lang().placeholder.password,error:e(s).errors.password_confirmation},null,8,["modelValue","placeholder","error"]),o(m,{class:"mt-2",message:e(s).errors.password_confirmation},null,8,["message"])]),l("div",j,[o(S,{class:h({"opacity-25":e(s).processing}),disabled:e(s).processing},{default:n(()=>[v(i(a.lang().button.reset_password)+" "+i(e(s).processing?"...":""),1)]),_:1},8,["class","disabled"])])],40,N)]),_:1})],64))}};export{H as default};