import React from 'react';

interface Props {
  size?: 'small' | 'medium' | 'large';
  variant?: 'primary' | 'secondary' | 'disabled';
  disabled?: boolean;
  children?: React.ReactNode;
  onClick: () => void;
  className?: string;
}

export const Button = ({
  size = 'medium',
  variant = 'primary',
  disabled = false,
  children,
  onClick,
  className,
}: Props) => {
  const handleClick = () => {
    onClick();
  };
  let classNames: string = '';
  const sizeStyles: string =
    size === 'large'
      ? 'w-[220px]'
      : size === 'small'
        ? 'w-[120px]'
        : 'w-[160px]';

  switch (variant) {
    case 'primary':
      classNames =
        'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800';
      break;
    case 'secondary':
      classNames =
        'font-medium text-gray-900  bg-white border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700';
      break;
    case 'disabled':
      classNames = 'bg-gray-300 px-4 py-2 cursor-not-allowed opacity-50';
      break;
  }

  return (
    <>
      <button
        type='button'
        className={`self-center
 text-sm rounded-lg px-5 py-2.5 me-2 mb-2 focus:outline-none ${classNames} ${sizeStyles} ${className}`}
        onClick={handleClick}
        disabled={disabled}
      >
        {children}
      </button>
    </>
  );
};
