import React, {
  createContext,
  useContext,
  useState,
  useCallback,
  useEffect,
} from 'react';
import { getAllModules } from '../api/modules';
import { Module } from '../types';

interface DisplayContextType {
  modules: Module[];
  page: number;
  totalPages: number;
  setPage: (page: number) => void;
  refreshModules: () => void;
}

const DisplayContext = createContext<DisplayContextType | undefined>(undefined);

export const DisplayProvider: React.FC<{ children: React.ReactNode }> = ({
  children,
}) => {
  const [modules, setModules] = useState<Module[]>([]);
  const [page, setPage] = useState(1);
  const [totalPages, setTotalPages] = useState(1);

  const fetchModules = useCallback(async (currentPage = 1) => {
    try {
      const response = await getAllModules(currentPage, 6);
      setModules(response.data);
      setTotalPages(response.pages);
    } catch (error) {
      console.error('Erreur de chargement des modules :', error);
    }
  }, []);

  const refreshModules = () => {
    fetchModules(page);
  };

  useEffect(() => {
    fetchModules(page);
  }, [page, fetchModules]);

  return (
    <DisplayContext.Provider
      value={{
        modules,
        page,
        totalPages,
        setPage,
        refreshModules,
      }}
    >
      {children}
    </DisplayContext.Provider>
  );
};

export const useDisplay = (): DisplayContextType => {
  const context = useContext(DisplayContext);
  if (!context) {
    throw new Error('useDisplay doit être utilisé dans un DisplayProvider');
  }
  return context;
};
