import{_ as g}from"./GuestLayout-3f0ead6f.js";import{f as y,q as v,l as w}from"./index-78a13632.js";import{o as i,c as b,w as p,a as s,t as a,b as e,u as o,d as f,f as k,x as I,F as B,e as L}from"./app-a96b9404.js";import"./Banner-8bba34a4.js";import"./_plugin-vue_export-helper-c27b6911.js";import"./index-6181452d.js";import"./ApplicationLogo-ad1997ea.js";import"./SwitchDarkMode-538c7276.js";const j={class:"bg-white min-h-[calc(100vh-64px)] dark:bg-slate-900"},C={"data-aos":"fade-up","data-aos-duration":"1000",class:"max-w-7xl mx-auto items-center px-4 sm:px-6 lg:px-8 pt-20 pb-8"},D={class:"w-full block md:grid md:grid-cols-7 gap-10 space-y-6 md:space-y-0"},N={class:"col-span-5"},T={class:"text-2xl font-semibold"},V={class:"flex justify-start items-center gap-1 text-sm"},F={class:""},H={class:""},M={class:"my-6 w-full block md:grid md:grid-cols-7 gap-10 space-y-6 md:space-y-0"},O={class:"col-span-5 space-y-4"},S=["src","alt"],q=["innerHTML"],E={class:"col-span-2 space-y-4"},R=s("h1",{class:"text-xl font-semibold"},[L(" Informasi "),s("span",{class:"text-primary"},"Lainnya")],-1),U={class:"space-y-1"},$={class:"flex space-x-2"},Y={__name:"InformationDetail",props:{title:String,information:Object,moreInformation:Object},setup(h){const t=h;return(u,z)=>(i(),b(g,{title:t.title},{default:p(()=>{var n,l,c,r,d,_;return[s("section",j,[s("div",C,[s("div",D,[s("div",N,[s("p",T,a(t.title),1),s("div",V,[e(o(y),{class:"w-3 h-auto"}),s("p",F,a((l=(n=t.information)==null?void 0:n.user)==null?void 0:l.name),1),e(o(v),{class:"ml-2 w-3 h-auto"}),s("p",H,a((c=t.information)==null?void 0:c.date_view),1)])])]),s("div",M,[s("div",O,[s("img",{class:"rounded shadow",src:(r=t.information)==null?void 0:r.full_path_image,alt:(d=t.information)==null?void 0:d.title},null,8,S),s("p",{class:"no-tailwindcss-base",innerHTML:(_=t.information)==null?void 0:_.text},null,8,q)]),s("div",E,[R,s("ul",U,[(i(!0),f(B,null,k(t.moreInformation,(m,x)=>(i(),f("li",{key:x},[e(o(I),{class:"hover:text-primary",href:u.route("guest.information-detail",{slug:m.slug})},{default:p(()=>[s("div",$,[e(o(w),{class:"w-4 h-auto flex-shrink-0"}),s("p",null,a(m.title),1)])]),_:2},1032,["href"])]))),128))])])])])])]}),_:1},8,["title"]))}};export{Y as default};