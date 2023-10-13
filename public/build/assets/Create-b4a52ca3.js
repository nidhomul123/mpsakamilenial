import{r as K,v as S,o as $,d as C,b as o,w as m,u as l,a as n,t as d,p as y,e as _,a4 as u,n as U}from"./app-a96b9404.js";import{_ as B}from"./DialogModal-02108549.js";import{_ as i}from"./InputError-9f6d638b.js";import{_ as p}from"./InputLabel-aac3b093.js";import{_ as V}from"./PrimaryButton-aac607c9.js";import{_ as N}from"./SecondaryButton-f6d0588b.js";import{_ as c}from"./TextInput-c0b06f0e.js";import{_ as j}from"./SelectInput-6bf14167.js";import{P as E}from"./index-78a13632.js";import"./Modal-f6002513.js";const M={class:"hidden md:block"},P=["onSubmit"],z={class:"space-y-1"},D={class:"space-y-1"},F={class:"space-y-1"},I={class:"space-y-1"},O={class:"space-y-1"},X={__name:"Create",props:{title:String,roles:Object},setup(h){var v,b;const f=h,w=K(!1),e=S({name:"",email:"",password:"",password_confirmation:"",role:(v=f.roles[1])==null?void 0:v.name}),t=()=>{e.post(route("user.store"),{preserveScroll:!0,onSuccess:()=>g(),onError:()=>null,onFinish:()=>null})},g=()=>{w.value=!1,e.errors={},e.reset()},k=(b=f.roles)==null?void 0:b.map(a=>({label:a.name,value:a.name}));return(a,s)=>($(),C("div",null,[o(V,{class:"flex rounded-none items-center justify-start gap-2",onClick:s[0]||(s[0]=y(r=>w.value=!0,["prevent"]))},{default:m(()=>[o(l(E),{class:"w-4 h-auto"}),n("span",M,d(a.lang().label.add),1)]),_:1}),o(B,{show:w.value,onClose:g},{title:m(()=>[_(d(a.lang().label.add)+" "+d(f.title),1)]),content:m(()=>[n("form",{class:"space-y-2",onSubmit:y(t,["prevent"])},[n("div",z,[o(p,{for:"name",value:a.lang().label.name},null,8,["value"]),o(c,{id:"name",modelValue:l(e).name,"onUpdate:modelValue":s[1]||(s[1]=r=>l(e).name=r),type:"text",class:"block w-full",autocomplete:"name",placeholder:a.lang().placeholder.name,error:l(e).errors.name,onKeyup:u(t,["enter"])},null,8,["modelValue","placeholder","error","onKeyup"]),o(i,{message:l(e).errors.name},null,8,["message"])]),n("div",D,[o(p,{for:"email",value:a.lang().label.email},null,8,["value"]),o(c,{id:"email",modelValue:l(e).email,"onUpdate:modelValue":s[2]||(s[2]=r=>l(e).email=r),type:"email",class:"block w-full",placeholder:a.lang().placeholder.email,error:l(e).errors.email,onKeyup:u(t,["enter"])},null,8,["modelValue","placeholder","error","onKeyup"]),o(i,{message:l(e).errors.email},null,8,["message"])]),n("div",F,[o(p,{for:"password",value:a.lang().label.password},null,8,["value"]),o(c,{id:"password",modelValue:l(e).password,"onUpdate:modelValue":s[3]||(s[3]=r=>l(e).password=r),type:"password",class:"block w-full",placeholder:a.lang().placeholder.password,error:l(e).errors.password,onKeyup:u(t,["enter"])},null,8,["modelValue","placeholder","error","onKeyup"]),o(i,{message:l(e).errors.password},null,8,["message"])]),n("div",I,[o(p,{for:"password_confirmation",value:a.lang().label.password_confirmation},null,8,["value"]),o(c,{id:"password_confirmation",modelValue:l(e).password_confirmation,"onUpdate:modelValue":s[4]||(s[4]=r=>l(e).password_confirmation=r),type:"password",class:"block w-full",placeholder:a.lang().placeholder.password,error:l(e).errors.password_confirmation,onKeyup:u(t,["enter"])},null,8,["modelValue","placeholder","error","onKeyup"]),o(i,{message:l(e).errors.password_confirmation},null,8,["message"])]),n("div",O,[o(p,{for:"role",value:a.lang().label.role},null,8,["value"]),o(j,{id:"role",modelValue:l(e).role,"onUpdate:modelValue":s[5]||(s[5]=r=>l(e).role=r),dataSet:l(k),class:"block w-full",error:l(e).errors.role},null,8,["modelValue","dataSet","error"]),o(i,{message:l(e).errors.role},null,8,["message"])])],40,P)]),footer:m(()=>[o(N,{onClick:g},{default:m(()=>[_(d(a.lang().button.cancel),1)]),_:1}),o(V,{class:U(["ml-3",{"opacity-25":l(e).processing}]),disabled:l(e).processing,onClick:t},{default:m(()=>[_(d(a.lang().button.save)+" "+d(l(e).processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}};export{X as default};