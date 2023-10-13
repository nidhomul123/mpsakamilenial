import{h as C,i as O,O as V,m as B,o as c,c as v,w as n,a as e,t as i,b as o,j as d,k as m,u as p,d as u,f as D,l as P,x as U,F as N}from"./app-a96b9404.js";import{_ as A}from"./AppLayout-5f685138.js";import{T as E}from"./Table-cc2bf8f5.js";import{_ as F}from"./Breadcrumb-cba4c0d4.js";import{_ as K}from"./SelectInput-6bf14167.js";import{_ as L}from"./TablePagination-80699fd5.js";import{_ as T}from"./TextInput-c0b06f0e.js";import M from"./Create-4da69d16.js";import q from"./Edit-cb2925ef.js";import z from"./Delete-a29b0500.js";import G from"./DeleteBulk-06d40757.js";import{p as H}from"./empty-58786c2e.js";import{C as b,p as J}from"./index-78a13632.js";import{_ as Q}from"./Checkbox-84e5da5f.js";import"./Banner-8bba34a4.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./index-6181452d.js";import"./SwitchDarkMode-538c7276.js";import"./ApplicationLogo-ad1997ea.js";import"./DialogModal-02108549.js";import"./Modal-f6002513.js";import"./ImageInput-ba4ecf39.js";import"./InputError-9f6d638b.js";import"./InputLabel-aac3b093.js";import"./PrimaryButton-aac607c9.js";import"./SecondaryButton-f6d0588b.js";import"./TextAreaInput-687fbf4c.js";import"./vue-quill.snow-44c41065.js";import"./ActionButton-80eb8da3.js";import"./ConfirmationModal-80b8e5de.js";import"./DangerButton-fb577737.js";const R={class:"py-6"},W={class:"max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4"},X={class:"bg-white dark:bg-slate-800 overflow-hidden shadow sm:rounded"},Y={class:"flex shrink-0 rounded overflow-hidden"},Z={class:"flex justify-end items-center gap-2"},ee={class:"flex space-x-2"},te={class:"p-4 text-left"},se=e("th",{class:"p-4 text-center"},"#",-1),ae={class:"flex justify-between items-center"},le={class:"flex justify-between items-center"},re=e("span",null,"Deskripsi",-1),oe=e("th",{class:"p-4 text-center"},"Krida",-1),ie={class:"flex justify-between items-center"},ne={class:"p-4 text-left"},ce=e("th",{class:"p-4 text-center sr-only"},"Action",-1),de={class:"whitespace-nowrap px-4 py-2"},pe=["value"],me={class:"whitespace-nowrap px-4 py-2 text-center"},ue={class:"whitespace-nowrap px-4 py-2 max-w-xs truncate"},he={class:"flex space-x-2 items-center"},fe=["src","alt"],_e={class:"max-w-[200px] truncate"},be={key:0,class:"text-primary underline"},ge={key:1,class:"text-primary underline"},we={class:"whitespace-nowrap px-4 py-2 max-w-xs truncate"},xe={class:"whitespace-nowrap px-4 py-2 max-w-xs truncate"},ke={class:"whitespace-nowrap px-4 py-2"},ve={class:"whitespace-nowrap px-4 py-2"},ye={class:"whitespace-nowrap flex justify-end px-4 py-2"},je={class:"flex w-fit rounded overflow-hidden"},st={__name:"Index",props:{title:String,filters:Object,subjects:Object,grades:Object,breadcrumbs:Object,perPage:Number},setup(g){const r=g,{_:y,debounce:j,pickBy:$}=H,t=C({params:{search:r.filters.search,field:r.filters.field,order:r.filters.order,perPage:r.perPage},selectedId:[],multipleSelect:!1,subject:null}),h=a=>{t.params.field=a,t.params.order=t.params.order==="asc"?"desc":"asc"};O(()=>y.cloneDeep(t.params),j(()=>{let a=$(t.params);V.get(route("subject.index"),a,{replace:!0,preserveState:!0,preserveScroll:!0})},150));const I=a=>{var l;a.target.checked===!1?t.selectedId=[]:(l=r.subjects)==null||l.data.forEach(f=>{t.selectedId.push(f.id)})},S=()=>{var a;((a=r.subjects)==null?void 0:a.data.length)==t.selectedId.length?t.multipleSelect=!0:t.multipleSelect=!1};return(a,l)=>{const f=B("tooltip");return c(),v(A,{title:r.title},{title:n(()=>[e("span",null,i(r.title),1)]),breadcrumb:n(()=>[o(F)]),default:n(()=>[e("div",R,[e("div",W,[e("div",X,[o(E,null,{"table-action":n(()=>[e("div",Y,[d(o(M,{title:r.title,grades:r.grades},null,8,["title","grades"]),[[m,a.can(["subject create"])]]),d(o(G,{selectedId:t.selectedId,title:r.title,onClose:l[0]||(l[0]=s=>(t.selectedId=[],t.multipleSelect=!1))},null,8,["selectedId","title"]),[[m,t.selectedId.length!=0&&a.can(["subject delete"])]])]),e("div",Z,[e("div",ee,[o(K,{class:"h-9 text-sm",modelValue:t.params.perPage,"onUpdate:modelValue":l[1]||(l[1]=s=>t.params.perPage=s),dataSet:a.$page.props.app.perpage},null,8,["modelValue","dataSet"])]),o(T,{modelValue:t.params.search,"onUpdate:modelValue":l[2]||(l[2]=s=>t.params.search=s),type:"text",class:"block h-9",placeholder:a.lang().placeholder.search},null,8,["modelValue","placeholder"])])]),"table-head":n(()=>[e("tr",null,[e("th",te,[o(Q,{checked:t.multipleSelect,"onUpdate:checked":l[3]||(l[3]=s=>t.multipleSelect=s),onChange:I},null,8,["checked"])]),se,e("th",{class:"p-4 cursor-pointer",onClick:l[4]||(l[4]=s=>h("name"))},[e("div",ae,[e("span",null,i(a.lang().label.name),1),o(p(b),{class:"w-4 h-4"})])]),e("th",{class:"p-4 cursor-pointer",onClick:l[5]||(l[5]=s=>h("description"))},[e("div",le,[re,o(p(b),{class:"w-4 h-4"})])]),oe,e("th",{class:"p-4 cursor-pointer",onClick:l[6]||(l[6]=s=>h("created_at"))},[e("div",ie,[e("span",null,i(a.lang().label.created),1),o(p(b),{class:"w-4 h-4"})])]),e("th",ne,i(a.lang().label.by),1),ce])]),"table-body":n(()=>[(c(!0),u(N,null,D(g.subjects.data,(s,w)=>{var x,k;return c(),u("tr",{key:w,class:"border-t border-slate-200 dark:border-slate-700 hover:bg-slate-200/30 hover:dark:bg-slate-900/20"},[e("td",de,[d(e("input",{class:"rounded dark:bg-slate-900 border-slate-300 dark:border-slate-700 text-primary dark:text-primary shadow-sm focus:ring-primary/80 dark:focus:ring-primary dark:focus:ring-offset-slate-800 dark:checked:bg-primary dark:checked:border-primary",type:"checkbox",onChange:S,value:s.id,"onUpdate:modelValue":l[7]||(l[7]=_=>t.selectedId=_)},null,40,pe),[[P,t.selectedId]])]),e("td",me,i(++w),1),e("td",ue,[e("div",he,[e("img",{class:"w-10 h-10 object-cover rounded",src:s.full_path_image,alt:s.title},null,8,fe),e("div",null,[e("p",_e,i(s.title),1),d((c(),v(p(U),{class:"flex items-center gap-1 text-sm",href:a.route("subject.show",{subject:s.id})},{default:n(()=>[o(p(J),{class:"w-4 h-auto"}),s.comments?(c(),u("span",ge,i(s.comments.length)+" komentar",1)):(c(),u("span",be,"Belum ada komentar"))]),_:2},1032,["href"])),[[f,"Klik untuk melihat komentar"]])])])]),e("td",we,i(s.description),1),e("td",xe,i((x=s.grade)==null?void 0:x.name),1),e("td",ke,i(s.created_at),1),e("td",ve,i((k=s.user)==null?void 0:k.name),1),e("td",ye,[e("div",je,[d(o(q,{title:r.title,subject:t.subject,grades:r.grades,onOpen:_=>t.subject=s},null,8,["title","subject","grades","onOpen"]),[[m,a.can(["subject update"])]]),d(o(z,{title:r.title,subject:t.subject,onOpen:_=>t.subject=s},null,8,["title","subject","onOpen"]),[[m,a.can(["subject delete"])]])])])])}),128))]),"table-pagination":n(()=>[o(L,{links:r.subjects,filters:t.params},null,8,["links","filters"])]),_:1})])])])]),_:1},8,["title"])}}};export{st as default};
