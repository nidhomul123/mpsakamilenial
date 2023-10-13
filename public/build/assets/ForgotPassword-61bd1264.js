import{v as p,o as n,d,b as a,u as s,X as _,w as r,a as o,t as l,g as f,n as g,e as b,p as h,F as w}from"./app-a96b9404.js";import{_ as v}from"./AuthenticationCard-bf5a1d06.js";import{_ as x}from"./AuthenticationCardLogo-d790809c.js";import{_ as V}from"./InputError-9f6d638b.js";import{_ as k}from"./InputLabel-aac3b093.js";import{_ as y}from"./PrimaryButton-aac607c9.js";import{_ as $}from"./TextInput-c0b06f0e.js";import"./SwitchDarkMode-538c7276.js";import"./index-78a13632.js";import"./ApplicationLogo-ad1997ea.js";import"./_plugin-vue_export-helper-c27b6911.js";const N={class:"flex flex-col mb-4"},S={class:"text-primary font-semibold text-xl"},B={class:"text-slate-400"},C={key:0,class:"mb-4 font-medium text-sm text-green-600 dark:text-green-400"},F=["onSubmit"],j={class:"flex items-center justify-end mt-4"},H={__name:"ForgotPassword",props:{status:String},setup(i){const e=p({email:""}),c=()=>{e.post(route("password.email"))};return(t,m)=>(n(),d(w,null,[a(s(_),{title:t.lang().label.forgot_password},null,8,["title"]),a(v,null,{logo:r(()=>[a(x)]),default:r(()=>[o("div",N,[o("h2",S,l(t.lang().label.forgot_password),1),o("small",B,l(t.lang().label.forgot_password_caption),1)]),i.status?(n(),d("div",C,l(i.status),1)):f("",!0),o("form",{onSubmit:h(c,["prevent"])},[o("div",null,[a(k,{for:"email",value:t.lang().label.email},null,8,["value"]),a($,{id:"email",modelValue:s(e).email,"onUpdate:modelValue":m[0]||(m[0]=u=>s(e).email=u),type:"email",class:"mt-1 block w-full",required:"",autofocus:"",autocomplete:"username",placeholder:t.lang().placeholder.email,error:s(e).errors.email},null,8,["modelValue","placeholder","error"]),a(V,{class:"mt-2",message:s(e).errors.email},null,8,["message"])]),o("div",j,[a(y,{class:g({"opacity-25":s(e).processing}),disabled:s(e).processing},{default:r(()=>[b(l(t.lang().button.email_password_reset_link)+" "+l(s(e).processing?"...":""),1)]),_:1},8,["class","disabled"])])],40,F)]),_:1})],64))}};export{H as default};