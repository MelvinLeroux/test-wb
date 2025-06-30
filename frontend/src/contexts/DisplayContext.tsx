import React, {
  createContext,
  useContext,
  useState,
  useCallback,
  useEffect,
} from 'react';
import { getAllModules } from '../api/modules';
import { Module } from '../types';
import { deleteModule } from '../api/module';

interface DisplayContextType {
  modules: Module[];
  page: number;
  totalPages: number;
  setPage: (page: number) => void;
  deleteModuleById: (id: number) => void;
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

  const deleteModuleById = async (id: number) => {
    try {
      await deleteModule(id);
      setModules(prevModules => prevModules.filter(module => module.id !== id));
    } catch (err) {
      console.error('Erreur lors de la suppression du module :', err);
    }
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
        deleteModuleById,
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
