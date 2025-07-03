import React, { createContext, useContext, useState } from 'react';
import { User } from '../types';
import { login } from '../api/login';

interface IAuthContext {
  currentUser: User | undefined;
  fetchAuth: (user: User) => Promise<void>;
  logout: () => Promise<void>;
}

export const AuthContext = createContext<IAuthContext | undefined>(undefined); // export ici

export const AuthProvider: React.FC<{ children: React.ReactNode }> = ({
  children,
}) => {
  const [currentUser, setCurrentUser] = useState<User | undefined>(undefined);

  const fetchAuth = async (user: User): Promise<void> => {
    try {
      await login(user);
      setCurrentUser(user);
    } catch (err) {
      console.error(err, 'Erreur lors de la connexion');
    }
  };
  const logout = async (): Promise<void> => {
    try {
      setCurrentUser(undefined);
    } catch (err) {
      console.error(err, 'erreur lors de la deonnexion');
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
