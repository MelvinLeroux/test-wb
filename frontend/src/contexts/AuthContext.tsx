import React, { createContext, useContext, useState } from 'react';
import { LoggedUser, UserLogin } from '../types';
import { login } from '../api/login';
import * as Sentry from '@sentry/react';
interface IAuthContext {
  currentUser: LoggedUser | undefined;
  fetchAuth: (user: UserLogin) => Promise<void>;
  logout: () => Promise<void>;
}

export const AuthContext = createContext<IAuthContext | undefined>(undefined);

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({
  children,
}) => {
  const [currentUser, setCurrentUser] = useState<LoggedUser | undefined>(
    undefined
  );

  const fetchAuth = async (user: UserLogin): Promise<void> => {
    try {
      const { token, user: currentUser } = await login(user);
      localStorage.setItem('token', token);
      setCurrentUser(currentUser);
    } catch (err) {
      console.error(err);
      Sentry.captureException(err);
      // const new = new Error('Erreur pendant la connexion');
    }
  };
  const logout = async (): Promise<void> => {
    try {
      setCurrentUser(undefined);
      localStorage.removeItem('token');
    } catch (err) {
      Sentry.captureException(err);
    }
  };

  return (
    <AuthContext.Provider value={{ currentUser, fetchAuth, logout }}>
      {children}
    </AuthContext.Provider>
  );
};
export const useAuth = (): IAuthContext => {
  const context = useContext(AuthContext);
  if (!context) {
    throw new Error('UseAuth doit ê utilisé dans un AuthProvider');
  }
  return context;
};
