'use client';

import React from 'react';
import { Container, Box, CssBaseline } from '@mui/material';

export default function Wrapper({ children, maxWidth = 'md', padding = 2, margin = 0 }) {
  return (
    <>
      <CssBaseline />
      <Container maxWidth={maxWidth}>
        <Box padding={padding} margin={margin} bgcolor="#FF0000" minHeight="100vh"
      width="100%">
          {children}
        </Box>
      </Container>
    </>
  );
}
