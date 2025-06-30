import React from 'react';
import { Button } from '../../design-system/Button';
interface ModulePaginationProps {
  page: number;
  totalPages: number;
  onPageChange: (page: number) => void;
}

const ModulePagination: React.FC<ModulePaginationProps> = ({
  page,
  totalPages,
  onPageChange,
}) => {
  if (totalPages <= 1) return null;

  const pages: number[] = [];
  for (let i = 1; i <= totalPages; i++) {
    pages.push(i);
  }

  return (
    <div className='flex justify-center mt-8 gap-2'>
      <Button
        onClick={() => onPageChange(page - 1)}
        disabled={page === 1}
        className='px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 disabled:opacity-50'
      >
        Précédent
      </Button>
      {pages.map(p => (
        <Button
          key={p}
          onClick={() => onPageChange(p)}
          className={`px-3 py-1 rounded ${
            p === page
              ? 'bg-blue-500 text-white'
              : 'bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-600'
          }`}
        >
          {p}
        </Button>
      ))}
      <Button
        onClick={() => onPageChange(page + 1)}
        disabled={page === totalPages}
        className='px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 disabled:opacity-50'
      >
        Suivant
      </Button>
    </div>
  );
};

export default ModulePagination;
