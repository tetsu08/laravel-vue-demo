import { initializeApp } from "@firebase/app";
import { getAuth, browserSessionPersistence } from "@firebase/auth";

const firebaseConfig = {
  authDomain: <string>import.meta.env.VITE_FIREBASE_AUTH_DOMAIN,
  appId: <string>import.meta.env.VITE_FIREBASE_APP_ID,
  apiKey: <string>import.meta.env.VITE_FIREBASE_API_KEY
};
  
initializeApp(firebaseConfig);

getAuth().setPersistence(browserSessionPersistence);