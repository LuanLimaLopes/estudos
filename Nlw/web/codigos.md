### BACK-END

-  npm init -y
-  npm i typescript @types/node -D (instalando typescript e suas dependencias)
-  npx tsc --init (tsconfig, pesquisar no git e procurar a versão do node)
-  
-   (No TSCONFIG)  "noEmit" = True, (faz com que use o typescript para checagem de tipos e não para baddering da aplicação)
-   (No package.json) "type" = module (Permite fazer importações no arquivo usando equimascript)
-   
-  npm i fastify @fastify/cors fastify-type-provider-zod zod
-  
-  !zod é para validação
-  !cors é uma medida de segurança
-  
-  npm run dev
-  npm i @biomejs/biome -D
-  npx ultracite init
-  configurar biome, npx ultracite init (docs no site ultracite)
-  ferramenta para criar tabelas
-  npm i drizzle-orm
-  npm i drizzle-kit -D
-  npm i drizzle-seed -D
-  

### FRONT-END
- npm create vite@latest web
- npm install tailwindcss @tailwindcss/vite
- npm install -D @types/node
- npm i react-router-dom
- npm i @tanstack/react-query
- npx shadcn@latest add card badge
- npm i dayjs (formatar datas)
- npx shadcn@latest add form (formulario)
- npm i @hookform/resolvers (formulário)
- npx shadcn@latest add input (formulário)
- npx shadcn@latest add textarea (formulário)
  