import{r as F,h as M,v as N,B as z,m as O,o as u,d as _,j as y,c as A,w as c,b as a,u as t,p as S,e as b,t as d,a as i,F as w,f as x,l as I,n as C}from"./app-a96b9404.js";import{_ as L}from"./DialogModal-02108549.js";import{_ as $}from"./InputError-9f6d638b.js";import{_ as h}from"./InputLabel-aac3b093.js";import{_ as P}from"./ActionButton-80eb8da3.js";import{_ as T}from"./PrimaryButton-aac607c9.js";import{_ as q}from"./SecondaryButton-f6d0588b.js";import{_ as G}from"./TextInput-c0b06f0e.js";import{a as H}from"./index-78a13632.js";import{_ as J}from"./Checkbox-84e5da5f.js";import"./Modal-f6002513.js";const K=["onSubmit"],Q={class:"space-y-1"},R={class:"flex justify-start items-center space-x-2 mt-2"},W={class:"font-semibold text-primary capitalize"},X={class:"flex flex-wrap gap-4 mt-1 mb-4"},Y=["id","value"],ce={__name:"Edit",props:{title:String,permissions:Object,role:Object},emits:["open"],setup(V,{emit:j}){const o=V,g=F(!1),n=M({multipleSelect:!1}),e=N({name:"",guard_name:"web",permissions:[]});z(()=>{var s,l,p,r;g&&(e.name=(s=o.role)==null?void 0:s.name,e.permissions=(p=(l=o.role)==null?void 0:l.permissions)==null?void 0:p.map(f=>f.id)),o.permissions.reduce((f,m)=>f+m.data.length,0)==((r=o.role)==null?void 0:r.permissions.length)?n.multipleSelect=!0:n.multipleSelect=!1});const k=()=>{var s;e.put(route("role.update",(s=o.role)==null?void 0:s.id),{preserveScroll:!0,onSuccess:()=>v(),onError:()=>null,onFinish:()=>null})},v=()=>{g.value=!1,e.errors={},e.reset(),n.multipleSelect=!1},B=s=>{s.target.checked===!1?e.permissions=[]:o.permissions.forEach(l=>{l.data.forEach(p=>{e.permissions.push(p.id)})})},E=()=>{o.permissions.reduce((s,l)=>s+l.data.length,0)==e.permissions.length?n.multipleSelect=!0:n.multipleSelect=!1};return(s,l)=>{const p=O("tooltip");return u(),_("div",null,[y((u(),A(P,{onClick:l[0]||(l[0]=S(r=>(g.value=!0,j("open")),["prevent"]))},{default:c(()=>[a(t(H),{class:"w-4 h-auto"})]),_:1})),[[p,s.lang().label.edit]]),a(L,{show:g.value,onClose:v,"max-width":"md"},{title:c(()=>[b(d(s.lang().label.edit)+" "+d(o.title),1)]),content:c(()=>[i("form",{class:"space-y-2",onSubmit:S(k,["prevent"])},[i("div",Q,[a(h,{for:"name",value:s.lang().label.name},null,8,["value"]),a(G,{id:"name",modelValue:t(e).name,"onUpdate:modelValue":l[1]||(l[1]=r=>t(e).name=r),type:"text",class:"block w-full",autocomplete:"name",placeholder:s.lang().placeholder.role_name,error:t(e).errors.name},null,8,["modelValue","placeholder","error"]),a($,{message:t(e).errors.name},null,8,["message"])]),i("div",null,[a(h,{value:s.lang().label.permissions},null,8,["value"]),a($,{class:"mt-2",message:t(e).errors.permissions},null,8,["message"]),i("div",R,[a(J,{id:"permission-all",checked:n.multipleSelect,"onUpdate:checked":l[2]||(l[2]=r=>n.multipleSelect=r),onChange:B},null,8,["checked"]),a(h,{for:"permission-all",value:s.lang().label.check_all},null,8,["value"])]),(u(!0),_(w,null,x(o.permissions,(r,f)=>(u(),_("div",{class:"mt-2",key:f},[i("p",W,d(r.group),1),i("div",X,[(u(!0),_(w,null,x(r.data,(m,U)=>(u(),_("div",{class:"flex items-center justify-start space-x-2",key:U},[y(i("input",{onChange:E,class:"rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary",type:"checkbox",id:"permission_"+m.id,value:m.id,"onUpdate:modelValue":l[3]||(l[3]=D=>t(e).permissions=D)},null,40,Y),[[I,t(e).permissions]]),a(h,{for:"permission_"+m.id},{default:c(()=>[i("p",{class:C(m.name=="delete"?"text-red-500 font-semibold":"")},d(m.name),3)]),_:2},1032,["for"])]))),128))])]))),128))])],40,K)]),footer:c(()=>[a(q,{onClick:v},{default:c(()=>[b(d(s.lang().button.cancel),1)]),_:1}),a(T,{class:C(["ml-3",{"opacity-25":t(e).processing}]),disabled:t(e).processing,onClick:k},{default:c(()=>[b(d(s.lang().button.save)+" "+d(t(e).processing?"...":""),1)]),_:1},8,["class","disabled"])]),_:1},8,["show"])])}}};export{ce as default};