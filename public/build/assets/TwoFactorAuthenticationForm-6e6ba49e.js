import{r as v,h as E,o as a,d as l,a as d,A as U,b as r,w as s,e as u,t as o,a4 as B,n as k,y as z,v as I,z as O,i as R,c as g,u as p,g as m,F as D,f as J,U as Q,O as A}from"./app-a96b9404.js";import{_ as j}from"./ActionSection-998c7e6a.js";import{_ as G}from"./DialogModal-02108549.js";import{_ as L}from"./InputError-9f6d638b.js";import{_ as $}from"./PrimaryButton-aac607c9.js";import{_ as S}from"./SecondaryButton-f6d0588b.js";import{_ as M}from"./TextInput-c0b06f0e.js";import{_ as W}from"./DangerButton-fb577737.js";import{_ as X}from"./InputLabel-aac3b093.js";import"./SectionTitle-a6a63d19.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./index-78a13632.js";import"./Modal-f6002513.js";const Y={class:"mt-4"},y={__name:"ConfirmsPassword",props:{title:{type:String,default:"Confirm Password"},content:{type:String,default:"For your security, please confirm your password to continue."},button:{type:String,default:"Confirm"}},emits:["confirmed"],setup(b,{emit:x}){const n=v(!1),e=E({password:"",error:"",processing:!1}),i=v(null),w=()=>{axios.get(route("password.confirmation")).then(c=>{c.data.confirmed?x("confirmed"):(n.value=!0,setTimeout(()=>i.value.focus(),250))})},h=()=>{e.processing=!0,axios.post(route("password.confirm"),{password:e.password}).then(()=>{e.processing=!1,f(),z().then(()=>x("confirmed"))}).catch(c=>{e.processing=!1,e.error=c.response.data.errors.password[0],i.value.focus()})},f=()=>{n.value=!1,e.password="",e.error=""};return(c,_)=>(a(),l("span",null,[d("span",{onClick:w},[U(c.$slots,"default")]),r(G,{show:n.value,onClose:f},{title:s(()=>[u(o(b.title),1)]),content:s(()=>[u(o(b.content)+" ",1),d("div",Y,[r(M,{ref_key:"passwordInput",ref:i,modelValue:e.password,"onUpdate:modelValue":_[0]||(_[0]=F=>e.password=F),type:"password",class:"mt-1 block w-full",placeholder:"Password",autocomplete:"current-password",onKeyup:B(h,["enter"]),error:e.error},null,8,["modelValue","onKeyup","error"]),r(L,{message:e.error,class:"mt-2"},null,8,["message"])])]),footer:s(()=>[r(S,{onClick:f},{default:s(()=>[u(" Cancel ")]),_:1}),r($,{class:k(["ml-3",{"opacity-25":e.processing}]),disabled:e.processing,onClick:h},{default:s(()=>[u(o(b.button)+" "+o(e.processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])]))}},Z={key:0,class:"text-lg font-medium text-slate-900 dark:text-slate-100"},ee={key:1,class:"text-lg font-medium text-slate-900 dark:text-slate-100"},te={key:2,class:"text-lg font-medium text-slate-900 dark:text-slate-100"},oe={class:"mt-3 max-w-xl text-sm text-slate-600 dark:text-slate-400"},ae={key:3},se={key:0},le={class:"mt-4 max-w-xl text-sm text-slate-600 dark:text-slate-400"},re={key:0,class:"font-semibold"},ne={key:1},ce=["innerHTML"],ue={key:0,class:"mt-4 max-w-xl text-sm text-slate-600 dark:text-slate-400"},ie={class:"font-semibold"},de=["innerHTML"],me={key:1,class:"mt-4"},fe={key:1},_e={class:"mt-4 max-w-xl text-sm text-slate-600 dark:text-slate-400"},pe={class:"font-semibold"},ve={class:"grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-slate-100 dark:bg-slate-900 rounded"},he={class:"mt-5"},we={key:0},ge={key:1},Be={__name:"TwoFactorAuthenticationForm",props:{requiresConfirmation:Boolean},setup(b){const x=b,n=v(!1),e=v(!1),i=v(!1),w=v(null),h=v(null),f=v([]),c=I({code:""}),_=O(()=>{var t;return!n.value&&((t=Q().props.auth.user)==null?void 0:t.two_factor_enabled)});R(_,()=>{_.value||(c.reset(),c.clearErrors())});const F=()=>{n.value=!0,A.post(route("two-factor.enable"),{},{preserveScroll:!0,onSuccess:()=>Promise.all([q(),H(),T()]),onFinish:()=>{n.value=!1,e.value=x.requiresConfirmation}})},q=()=>axios.get(route("two-factor.qr-code")).then(t=>{w.value=t.data.svg}),H=()=>axios.get(route("two-factor.secret-key")).then(t=>{h.value=t.data.secretKey}),T=()=>axios.get(route("two-factor.recovery-codes")).then(t=>{f.value=t.data}),V=()=>{c.post(route("two-factor.confirm"),{errorBag:"confirmTwoFactorAuthentication",preserveScroll:!0,preserveState:!0,onSuccess:()=>{e.value=!1,w.value=null,h.value=null}})},N=()=>{axios.post(route("two-factor.recovery-codes")).then(()=>T())},K=()=>{i.value=!0,A.delete(route("two-factor.disable"),{preserveScroll:!0,onSuccess:()=>{i.value=!1,e.value=!1}})};return(t,P)=>(a(),g(j,null,{title:s(()=>[u(o(t.lang().label.two_factor_auth),1)]),description:s(()=>[u(o(t.lang().label.two_factor_auth_desctiption),1)]),content:s(()=>[p(_)&&!e.value?(a(),l("h3",Z,o(t.lang().label.two_factor_auth_enabled),1)):p(_)&&e.value?(a(),l("h3",ee,o(t.lang().label.two_factor_auth_enabling),1)):(a(),l("h3",te,o(t.lang().label.two_factor_auth_not_enabled),1)),d("div",oe,[d("p",null,o(t.lang().label.two_factor_auth_caption),1)]),p(_)?(a(),l("div",ae,[w.value?(a(),l("div",se,[d("div",le,[e.value?(a(),l("p",re,o(t.lang().label.two_factor_auth_finish),1)):(a(),l("p",ne,o(t.lang().label.two_factor_auth_now_enabled),1))]),d("div",{class:"mt-4",innerHTML:w.value},null,8,ce),h.value?(a(),l("div",ue,[d("p",ie,[u(" Setup Key: "),d("span",{innerHTML:h.value},null,8,de)])])):m("",!0),e.value?(a(),l("div",me,[r(X,{for:"code",value:t.lang().label.code},null,8,["value"]),r(M,{id:"code",modelValue:p(c).code,"onUpdate:modelValue":P[0]||(P[0]=C=>p(c).code=C),type:"text",name:"code",class:"block mt-1 w-1/2",inputmode:"numeric",autofocus:"",autocomplete:"one-time-code",placeholder:"••••••",onKeyup:B(V,["enter"]),error:p(c).errors.code},null,8,["modelValue","onKeyup","error"]),r(L,{message:p(c).errors.code,class:"mt-2"},null,8,["message"])])):m("",!0)])):m("",!0),f.value.length>0&&!e.value?(a(),l("div",fe,[d("div",_e,[d("p",pe,o(t.lang().label.two_factor_auth_recovery_code),1)]),d("div",ve,[(a(!0),l(D,null,J(f.value,C=>(a(),l("div",{key:C},o(C),1))),128))])])):m("",!0)])):m("",!0),d("div",he,[p(_)?(a(),l("div",ge,[r(y,{onConfirmed:V},{default:s(()=>[e.value?(a(),g($,{key:0,type:"button",class:k(["mr-3",{"opacity-25":n.value}]),disabled:n.value},{default:s(()=>[u(o(t.lang().button.confirm)+" "+o(n.value?"...":""),1)]),_:1},8,["class","disabled"])):m("",!0)]),_:1}),r(y,{onConfirmed:N},{default:s(()=>[f.value.length>0&&!e.value?(a(),g(S,{key:0,class:"mr-3"},{default:s(()=>[u(o(t.lang().button.regenerate_recovery_codes),1)]),_:1})):m("",!0)]),_:1}),r(y,{onConfirmed:T},{default:s(()=>[f.value.length===0&&!e.value?(a(),g(S,{key:0,class:"mr-3"},{default:s(()=>[u(o(t.lang().button.show_recovery_codes),1)]),_:1})):m("",!0)]),_:1}),r(y,{onConfirmed:K},{default:s(()=>[e.value?(a(),g(S,{key:0,class:k({"opacity-25":i.value}),disabled:i.value},{default:s(()=>[u(o(t.lang().button.cancel)+" "+o(i.value?"...":""),1)]),_:1},8,["class","disabled"])):m("",!0)]),_:1}),r(y,{onConfirmed:K},{default:s(()=>[e.value?m("",!0):(a(),g(W,{key:0,class:k({"opacity-25":i.value}),disabled:i.value},{default:s(()=>[u(o(t.lang().button.disable)+" "+o(i.value?"...":""),1)]),_:1},8,["class","disabled"]))]),_:1})])):(a(),l("div",we,[r(y,{onConfirmed:F},{default:s(()=>[r($,{type:"button",class:k({"opacity-25":n.value}),disabled:n.value},{default:s(()=>[u(o(t.lang().button.enable)+" "+o(n.value?"...":""),1)]),_:1},8,["class","disabled"])]),_:1})]))])]),_:1}))}};export{Be as default};
