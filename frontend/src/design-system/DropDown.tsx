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
    <div className='relative inline-block text-left'>
      <Button onClick={() => setIsOpen(!isOpen)}>
        {selectedOption ? selectedOption.name : 'Options'}
        <ChevronDownIcon
          aria-hidden='true'
          className='-mr-1 size-5 text-gray-400'
        />
      </Button>

      {isOpen && (
        <div className='absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black/5 focus:outline-none'>
          <div className='py-1'>
            {options.map(option => (
              <Button
                onClick={() => handleChangeOption(option)}
                key={option.id}
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
