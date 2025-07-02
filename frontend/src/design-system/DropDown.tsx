import React from 'react';
import { ChevronDownIcon } from '@heroicons/react/20/solid';
import { useState } from 'react';
import { Button } from './Button';
interface Option {
  id: number;
  name: string;
}
type DropdownProps = {
  options: Option[];
  onDropDownChange: (option: Option) => void;
};

export function DropDown({ options, onDropDownChange }: DropdownProps) {
  const [isOpen, setIsOpen] = useState(false);
  const [selectedOption, setSelectedOption] = useState<Option | null>(null);

  function handleChangeOption(option: Option) {
    setIsOpen(false);
    setSelectedOption(option);
    onDropDownChange(option);
  }

  return (
    <div className='w-full'>
      <Button
        variant='dropdown'
        onClick={() => setIsOpen(!isOpen)}
        className='w-full flex text-center items-center'
      >
        {selectedOption ? selectedOption.name : 'Options'}
        <ChevronDownIcon
          aria-hidden='true'
          className='-mr-1 w-5 h-5 text-gray-400'
        />
      </Button>

      {isOpen && (
        <div className='absolute left-0 z-10 mt-2 w-full origin-top-left rounded-lg bg-gray-800 shadow-xl ring-1 ring-black/30'>
          <div className='flex flex-col p-1 w-full'>
            {options.map(option => (
              <Button
                onClick={() => handleChangeOption(option)}
                key={option.id}
                className='w-full text-center px-3 py-1'
              >
                {option.name}
              </Button>
            ))}
          </div>
        </div>
      )}
    </div>
  );
}
