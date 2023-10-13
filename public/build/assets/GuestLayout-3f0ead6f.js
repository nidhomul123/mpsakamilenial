import{h as k,m as $,j as f,k as m,o as u,d as b,b as s,u as c,c as x,w as i,e as h,t as r,x as y,a as t,n,p as j,O as B,X as S,A as O}from"./app-a96b9404.js";import{A as T,X as D,n as P}from"./index-78a13632.js";import{T as A,_ as C}from"./Banner-8bba34a4.js";import{B as I,_,a as L}from"./index-6181452d.js";import{A as N}from"./ApplicationLogo-ad1997ea.js";import{_ as v}from"./SwitchDarkMode-538c7276.js";import{_ as M}from"./_plugin-vue_export-helper-c27b6911.js";const z={__name:"BackToTop",setup(o){const a=k({show:!1}),d=()=>{window.scrollTo(0,0)};return window.addEventListener("scroll",()=>{window.scrollY>0?a.show=!0:a.show=!1}),(e,g)=>{const l=$("tooltip");return f((u(),b("a",{onClick:d,class:"h-10 w-10 bg-primary/50 fixed flex m-auto justify-center items-center z-[9999] bottom-4 right-4 rounded text-white hover:bg-primary cursor-pointer"},[s(c(T),{class:"w-6 h-6"})])),[[m,a.show],[l,e.lang().label.back_to_top]])}}},p={__name:"NavbarLink",props:{href:String,label:String},setup(o){return(a,d)=>(u(),x(c(y),{href:o.href,class:"inline-flex items-center justify-start sm:justify-center p-2 rounded hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 transition duration-150 ease-in-out w-full"},{default:i(()=>[h(r(o.label),1)]),_:1},8,["href"]))}},E={class:"flex flex-col max-w-7xl px-4 mx-auto sm:items-center sm:justify-between sm:flex-row sm:px-6 lg:px-8 py-2"},V={class:"flex items-center justify-between"},X={class:"text-lg font-semibold uppercase tracking-widest"},Y={class:"sm:hidden"},F={class:"relative"},G={class:"inline-flex items-center sm:justify-center p-2 rounded hover:bg-slate-100 dark:hover:bg-slate-800 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 transition duration-150 ease-in-out w-full gap-2 justify-between"},H={class:"block px-4 py-2 truncate border-b border-slate-200 dark:border-slate-600"},R={class:"flex items-center"},U={class:"block text-xs truncate"},q={class:"block px-4 py-2 text-xs text-slate-400"},J=t("div",{class:"border-t border-slate-200 dark:border-slate-600"},null,-1),K=["onSubmit"],Q={__name:"Navbar",setup(o){const a=k({isOpen:!1,fixed:!1});window.addEventListener("scroll",()=>{window.scrollY>0?a.fixed=!0:a.fixed=!1});const d=()=>{B.post(route("guest.member.logout"))};return(e,g)=>(u(),b("header",{class:n([a.fixed||a.isOpen?"bg-white/70 dark:bg-slate-900/70 backdrop-blur-lg border-b border-slate-300/50 dark:border-slate-700/50":"border-none","w-full fixed text-slate-600 dark:text-slate-200 z-50"])},[t("div",E,[t("div",V,[t("div",null,[s(c(y),{href:e.route("index"),class:"shrink-0 flex w-full justify-start items-center space-x-4"},{default:i(()=>[s(N,{class:"block h-8 w-auto"}),t("p",X,r(e.$page.props.app.setting.short_name),1)]),_:1},8,["href"])]),t("div",Y,[s(v),t("button",{onClick:g[0]||(g[0]=l=>a.isOpen=!a.isOpen),class:"inline-flex items-center justify-center p-2 rounded text-slate-400 dark:text-slate-500 hover:text-slate-500 dark:hover:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-900 focus:outline-none focus:bg-slate-100 dark:focus:bg-slate-900 focus:text-slate-500 dark:focus:text-slate-400 transition duration-150 ease-in-out"},[a.isOpen?(u(),x(c(D),{key:1,class:"w-6 h-auto"})):(u(),x(c(I),{key:0,class:"w-6 h-auto"}))])])]),t("nav",{class:n([a.isOpen?"":"hidden","relative sm:flex items-center space-y-2 sm:space-y-0 gap-2 py-4 sm:py-0"])},[s(p,{class:n(e.route().current("index")?"font-bold text-primary":""),href:e.route("index"),label:"Beranda"},null,8,["class","href"]),s(p,{class:n(e.route().current("guest.information")||e.route().current("guest.information-detail")?"font-bold text-primary":""),href:e.route("guest.information"),label:"Informasi"},null,8,["class","href"]),f(s(p,{class:n(e.route().current("guest.subject")||e.route().current("guest.subject-detail")?"font-bold text-primary":""),href:e.route("guest.subject"),label:"Materi"},null,8,["class","href"]),[[m,e.$page.props.app.member]]),f(s(p,{class:n(e.route().current("guest.exam")||e.route().current("guest.exam-index")?"font-bold text-primary":""),href:e.route("guest.exam"),label:"Penilaian"},null,8,["class","href"]),[[m,e.$page.props.app.member]]),f(s(p,{href:e.route("guest.member.login"),label:"Masuk/Daftar"},null,8,["href"]),[[m,!e.$page.props.app.member]]),f(t("div",F,[s(L,{align:"right",width:"48"},{trigger:i(()=>{var l;return[t("div",G,[t("button",{class:n([e.route().current("guest.member")||e.route().current("guest.exam-result")?"font-bold text-primary":"","max-w-[100px] truncate"])},r((l=e.$page.props.app.member)==null?void 0:l.name),3),s(c(P),{class:"w-4 h-4"})])]}),content:i(()=>{var l,w;return[t("div",H,[t("div",R,[t("p",null,r((l=e.$page.props.app.member)==null?void 0:l.name),1)]),t("div",U,r((w=e.$page.props.app.member)==null?void 0:w.email),1)]),t("div",q,r(e.lang().label.manage_account),1),s(_,{href:e.route("guest.exam-result")},{default:i(()=>[h(" Hasil Penilaian ")]),_:1},8,["href"]),s(_,{href:e.route("guest.member")},{default:i(()=>[h(r(e.lang().label.profile),1)]),_:1},8,["href"]),J,t("form",{onSubmit:j(d,["prevent"])},[s(_,{as:"button"},{default:i(()=>[h(r(e.lang().label.logout),1)]),_:1})],40,K)]}),_:1})],512),[[m,e.$page.props.app.member]]),s(v,{class:"hidden sm:block"})],2)])],2))}},W={},Z={class:"sticky top-[100vh]"},ee={class:"bg-white dark:bg-slate-900 border-t border-slate-100 dark:border-slate-800"},te={class:"max-w-7xl mx-auto flex justify-end items-center px-4 sm:px-6 lg:px-8 py-4"},se={class:"text-slate-600 dark:text-slate-400"};function ae(o,a){return u(),b("footer",Z,[t("div",ee,[t("div",te,[t("p",se,r(o.$page.props.app.setting.short_name+" v."+o.$page.props.app.version)+" © 2023-"+r(new Date().getFullYear()),1)])])])}const re=M(W,[["render",ae]]),oe={class:"flex relative w-full min-h-screen bg-white dark:bg-slate-900 text-slate-900 dark:text-slate-200 overflow-x-hidden"},le={class:"w-full"},ne={class:"text-slate-600 dark:text-slate-200"},he={__name:"GuestLayout",props:{title:String},setup(o){return(a,d)=>(u(),b("div",null,[s(c(S),{title:o.title},null,8,["title"]),s(A,{flash:a.$page.props.flash},null,8,["flash"]),s(C),t("div",oe,[t("div",le,[s(Q),t("main",ne,[O(a.$slots,"default"),s(z)]),s(re)])])]))}};export{he as _};