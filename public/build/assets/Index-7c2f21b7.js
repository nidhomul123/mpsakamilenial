import{h as I,i as S,O as C,o as f,c as j,w as i,a as e,t as n,b as r,j as d,k as c,u,d as g,f as O,l as V,n as P,F as B}from"./app-a96b9404.js";import{_ as U}from"./AppLayout-5f685138.js";import{T as D}from"./Table-cc2bf8f5.js";import{_ as T}from"./Breadcrumb-cba4c0d4.js";import{_ as N}from"./SelectInput-6bf14167.js";import{_ as A}from"./TablePagination-80699fd5.js";import{_ as E}from"./TextInput-c0b06f0e.js";import F from"./Create-fddd6cd7.js";import z from"./Edit-23eb936e.js";import J from"./Delete-554ca682.js";import L from"./DeleteBulk-131ae50c.js";import{p as M}from"./empty-58786c2e.js";import{C as h}from"./index-78a13632.js";import{_ as Y}from"./Checkbox-84e5da5f.js";import"./Banner-8bba34a4.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./index-6181452d.js";import"./SwitchDarkMode-538c7276.js";import"./ApplicationLogo-ad1997ea.js";import"./DialogModal-02108549.js";import"./Modal-f6002513.js";import"./ImageInput-ba4ecf39.js";import"./InputError-9f6d638b.js";import"./InputLabel-aac3b093.js";import"./PrimaryButton-aac607c9.js";import"./SecondaryButton-f6d0588b.js";import"./vue-quill.snow-44c41065.js";import"./ActionButton-80eb8da3.js";import"./ConfirmationModal-80b8e5de.js";import"./DangerButton-fb577737.js";const q={class:"py-6"},G={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4"},H={class:"bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded"},K={class:"flex shrink-0 rounded overflow-hidden"},Q={class:"flex justify-end items-center gap-2"},R={class:"flex space-x-2"},W={class:"p-4 text-left"},X=e("th",{class:"p-4 text-center"},"#",-1),Z={class:"flex justify-between items-center"},ee=e("span",null,"Judul",-1),te={class:"flex justify-between items-center"},se=e("span",null,"Publish",-1),ae={class:"flex justify-between items-center"},le=e("span",null,"Tanggal",-1),oe={class:"p-4 text-left"},re=e("th",{class:"p-4 text-center sr-only"}," Action ",-1),ie={class:"whitespace-nowrap px-4 py-2"},ne=["value"],de={class:"whitespace-nowrap px-4 py-2 text-center"},ce={class:"whitespace-nowrap px-4 py-2 max-w-xs truncate"},pe={class:"flex space-x-2 items-center"},me=["src","alt"],fe={class:"max-w-xs truncate"},ue={class:"whitespace-nowrap px-4 py-2"},he={class:"whitespace-nowrap px-4 py-2"},_e={class:"whitespace-nowrap flex justify-end px-4 py-2"},be={class:"flex w-fit rounded overflow-hidden"},Ke={__name:"Index",props:{title:String,filters:Object,information:Object,breadcrumbs:Object,perPage:Number},setup(_){const o=_,{_:x,debounce:k,pickBy:v}=M,t=I({params:{search:o.filters.search,field:o.filters.field,order:o.filters.order,perPage:o.perPage},selectedId:[],multipleSelect:!1,information:null}),p=l=>{t.params.field=l,t.params.order=t.params.order==="asc"?"desc":"asc"};S(()=>x.cloneDeep(t.params),k(()=>{let l=v(t.params);C.get(route("information.index"),l,{replace:!0,preserveState:!0,preserveScroll:!0})},150));const y=l=>{var a;l.target.checked===!1?t.selectedId=[]:(a=o.information)==null||a.data.forEach(s=>{t.selectedId.push(s.id)})},$=()=>{var l;((l=o.information)==null?void 0:l.data.length)==t.selectedId.length?t.multipleSelect=!0:t.multipleSelect=!1};return(l,a)=>(f(),j(U,{title:o.title},{title:i(()=>[e("span",null,n(o.title),1)]),breadcrumb:i(()=>[r(T)]),default:i(()=>[e("div",q,[e("div",G,[e("div",H,[r(D,null,{"table-action":i(()=>[e("div",K,[d(r(F,{title:o.title},null,8,["title"]),[[c,l.can(["information create"])]]),d(r(L,{selectedId:t.selectedId,title:o.title,onClose:a[0]||(a[0]=s=>(t.selectedId=[],t.multipleSelect=!1))},null,8,["selectedId","title"]),[[c,t.selectedId.length!=0&&l.can(["information delete"])]])]),e("div",Q,[e("div",R,[r(N,{class:"h-9 text-sm",modelValue:t.params.perPage,"onUpdate:modelValue":a[1]||(a[1]=s=>t.params.perPage=s),dataSet:l.$page.props.app.perpage},null,8,["modelValue","dataSet"])]),r(E,{modelValue:t.params.search,"onUpdate:modelValue":a[2]||(a[2]=s=>t.params.search=s),type:"text",class:"block h-9",placeholder:l.lang().placeholder.search},null,8,["modelValue","placeholder"])])]),"table-head":i(()=>[e("tr",null,[e("th",W,[r(Y,{checked:t.multipleSelect,"onUpdate:checked":a[3]||(a[3]=s=>t.multipleSelect=s),onChange:y},null,8,["checked"])]),X,e("th",{class:"p-4 cursor-pointer",onClick:a[4]||(a[4]=s=>p("title"))},[e("div",Z,[ee,r(u(h),{class:"w-4 h-4"})])]),e("th",{class:"p-4 cursor-pointer",onClick:a[5]||(a[5]=s=>p("published"))},[e("div",te,[se,r(u(h),{class:"w-4 h-4"})])]),e("th",{class:"p-4 cursor-pointer",onClick:a[6]||(a[6]=s=>p("created_at"))},[e("div",ae,[le,r(u(h),{class:"w-4 h-4"})])]),e("th",oe,n(l.lang().label.by),1),re])]),"table-body":i(()=>[(f(!0),g(B,null,O(_.information.data,(s,b)=>{var w;return f(),g("tr",{key:b,class:"border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"},[e("td",ie,[d(e("input",{class:"rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary",type:"checkbox",onChange:$,value:s.id,"onUpdate:modelValue":a[7]||(a[7]=m=>t.selectedId=m)},null,40,ne),[[V,t.selectedId]])]),e("td",de,n(++b),1),e("td",ce,[e("div",pe,[e("img",{class:"w-10 h-10 object-cover rounded",src:s.full_path_image,alt:s.name},null,8,me),e("p",fe,n(s.title),1)])]),e("td",{class:P([s.published?"text-green-500":"text-red-500","whitespace-nowrap px-4 py-2"])},n(s.published?"Ya":"Tidak"),3),e("td",ue,n(s.date_view),1),e("td",he,n((w=s.user)==null?void 0:w.name),1),e("td",_e,[e("div",be,[d(r(z,{title:o.title,information:t.information,onOpen:m=>t.information=s},null,8,["title","information","onOpen"]),[[c,l.can(["information update"])]]),d(r(J,{title:o.title,information:t.information,onOpen:m=>t.information=s},null,8,["title","information","onOpen"]),[[c,l.can(["information delete"])]])])])])}),128))]),"table-pagination":i(()=>[r(A,{links:o.information,filters:t.params},null,8,["links","filters"])]),_:1})])])])]),_:1},8,["title"]))}};export{Ke as default};