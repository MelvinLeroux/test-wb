import React from 'react';

interface Option {
  id: number;
  name: string;
}

type SelectProps = {
  defaultValue?: string;
  options: Option[];
  onSelectChange: (option: Option) => void;
};

export function Select({ defaultValue, options, onSelectChange }: SelectProps) {
  const handleChange = (e: React.ChangeEvent<HTMLSelectElement>) => {
    const value = e.target.value;
    const selectedOption = options.find(opt => opt.id.toString() === value);
    if (selectedOption) {
      onSelectChange(selectedOption);
    }
  };

  return (
    <div className='py-3 px-4 block w-full border-gray-200 rounded-lg text-sm focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600'>
      <select
        value={defaultValue}
        onChange={handleChange}
        className='dark:bg-neutral-900 dark:border-neutral-700 dark:text-neutral-400 dark:placeholder-neutral-500 dark:focus:ring-neutral-600 block w-full'
      >
        <option value=''>Choisir une option</option>
        {options.map(opt => (
          <option key={opt.id} value={opt.id.toString()}>
            {opt.name}
          </option>
        ))}
      </select>
    </div>
  );
}
