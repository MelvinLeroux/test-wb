/// <reference types="vite/client" />

interface ImportMetaEnv {
  readonly VITE_API_URL: string; // ajoute ici toutes les variables dont tu as besoin
}

interface ImportMeta {
  readonly env: ImportMetaEnv;
}
